<?php

namespace App\Livewire\Orders;

use Livewire\Component;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderLog;

class Form extends Component
{
    public $ba_name, $customer_name, $address, $order_date;
    public $payment_type;
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

    public $payment_types_arr = [
        'CASH', 
        'GCASH', 
        'P-WALLET', 
        'DEBIT', 
        'CC', 
        'OTHERS',
    ];

    public function render()
    {
        $this->computeTotal();

        return view('livewire.orders.form');
    }

    public function mount() {
        $this->ba_name = auth()->user()->name;
        $this->order_date = date('Y-m-d');

        $this->products = Product::all();

        foreach($this->products as $product) {
            $this->details[$product->id]['quantity'] = 0;
            $this->details[$product->id]['amount'] = NULL;
        }

    }

    public function selectPaymentType($type) {
        $this->payment_type = $type;
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
            'payment_type' => [
                'required'
            ],
        ]);

        $order = new Order([
            'user_id' => auth()->user()->id,
            'order_number' => $this->generateOrderNumber(),
            'customer_name' => $this->customer_name,
            'address' => $this->address,
            'order_date' => date('Y-m-d'),
            'total' => $this->total_amount,
            'status' => 'draft',
            'payment_type' => $this->payment_type,
        ]);
        $order->save();

        $this->order = $order;

        foreach($this->details as $product_id => $data) {
            $order_detail = new OrderDetail([
                'order_id' => $order->id,
                'product_id' => $product_id,
                'quantity' => $data['quantity'],
                'amount' => $data['amount'],
            ]);
            $order_detail->save();
        }
        
       

        

        $this->show_summary = 1;
    }

    public function submitOrder() {

        $this->order->update([
            'status' => 'submitted'
        ]);

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
        $this->resetExcept('ba_name', 'order_date', 'products');
    }
}
