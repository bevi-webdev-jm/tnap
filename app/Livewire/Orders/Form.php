<?php

namespace App\Livewire\Orders;

use Livewire\Component;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPaymentType;
use App\Models\OrderLog;
use App\Models\PaymentType;

use Illuminate\Support\Facades\Session;

class Form extends Component
{
    public $ba_name, $customer_name, $address, $order_date;
    public $payment_type_arr;
    public $total_amount = 0;
    public $details;
    public $products;

    public $show_summary = 0;

    public $order;

    public $product_images_arr = [
        'KS99074' => 'images/45G.png',
        'KS99078' => 'images/65GX2.jpg',
        'KS99076' => 'images/65GX3.png',
        'KS99077' => 'images/100GX3.jpg',
    ];

    public function render()
    {
        $this->computeTotal();

        $payment_types = PaymentType::all();

        return view('livewire.orders.form')->with([
            'payment_types' => $payment_types
        ]);
    }

    public function mount() {
        $this->ba_name = auth()->user()->name;
        $this->order_date = date('Y-m-d');

        $this->products = Product::all();

        foreach($this->products as $product) {
            $this->details[$product->id]['quantity'] = NULL;
            $this->details[$product->id]['amount'] = NULL;
        }

        $order = Session::get('re-order-data');
        if(!empty($order)) {
            $this->customer_name = $order->customer_name;
            $this->address = $order->address;

            Session::forget('re-order-data');
        }

    }

    public function selectPaymentType($payment_type_id) {
        if(isset($this->payment_type_arr[$payment_type_id])) {
            unset($this->payment_type_arr[$payment_type_id]);
        } else {
            $this->payment_type_arr[$payment_type_id] = '';
        }
    }

    public function computeTotal() {
        $total_amount = 0;
        if(!empty($this->details)) {
            foreach($this->details as $product_id => $data) {
                $product = $this->products->find($product_id);
                $amount = 0;
                // compute amount
                if(!empty($data['quantity'])) {
                    $amount = $data['quantity'] * $product->price;
                }

                $total_amount += $amount;

                $this->details[$product_id]['amount'] = $amount ?? 0;
            }
        }

        $this->total_amount = $total_amount;

    }

    private function generateOrderNumber()
    {
        do {
            $lastOrder = Order::orderBy('id', 'desc')->first();

            if ($lastOrder && preg_match('/ORD-(\d+)/', $lastOrder->order_number, $matches)) {
                $number = (int) $matches[1] + 1;
            } else {
                $number = 10001; // starting number
            }

            $order_number = 'ORD-' . $number;

        } while (Order::where('order_number', $order_number)->exists());

        return $order_number;
    }

    public function saveOrder() {
        $this->validate([
            'customer_name' => [
                'required'
            ],
            'address' => [
                'max:255'
            ],
        ]);

        $order = new Order([
            'user_id' => auth()->user()->id,
            'order_number' => $this->generateOrderNumber(),
            'customer_name' => $this->customer_name,
            'address' => $this->address,
            'order_date' => date('Y-m-d'),
            'total' => $this->total_amount,
            'status' => 'submitted',
        ]);
        $order->save();

        $this->order = $order;

        // details
        foreach($this->details as $product_id => $data) {
            if(!empty($data['quantity'])) {
                $order_detail = new OrderDetail([
                    'order_id' => $order->id,
                    'product_id' => $product_id,
                    'quantity' => $data['quantity'],
                    'amount' => $data['amount'],
                ]);
                $order_detail->save();
            }
        }

        // payment types
        foreach($this->payment_type_arr as $type_id => $amount) {
            if(count($this->payment_type_arr) <= 1) {
                $amount = $this->total_amount;
            }
            $order_payment_type = new OrderPaymentType([
                'order_id' => $order->id,
                'payment_type_id' => $type_id,
                'amount' => $amount ?? 0
            ]);
            $order_payment_type->save();
        }
        
        // order log
        $order_log = new OrderLog([
            'order_id' => $this->order->id,
            'user_id' => auth()->user()->id,
            'status' => 'submitted',
            'remarks' => NULL
        ]);
        $order_log->save();
        
        // log
        activity('created')
            ->performedOn($this->order)
            ->log(':causer.name has created an order :subject.order_number');

        $this->show_summary = 2;
    }

    public function newOrder() {

        return redirect()->route('order.create');
    }
}
