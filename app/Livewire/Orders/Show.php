<?php

namespace App\Livewire\Orders;

use Livewire\Component;

use App\Models\OrderLog;

use Illuminate\Support\Facades\Session;

class Show extends Component
{
    public $order;

    public $status_arr = [
        'draft'         => 'secondary',
        'submitted'     => 'info',
        'cancelled'     => 'danger',
        'completed'     => 'success',
    ];

    public $product_images_arr = [
        'KS99074' => 'images/45G.png',
        'KS99078' => 'images/65GX2.jpg',
        'KS99076' => 'images/65GX3.png',
        'KS99077' => 'images/100GX3.jpg',
    ];

    public function render()
    {
        return view('livewire.orders.show');
    }

    public function submitOrder() {
        $this->order->update([
            'status' => 'submitted'
        ]);

        // order log
        $log = new OrderLog([
            'order_id' => $this->order->id,
            'user_id' => auth()->user()->id,
            'status' => 'submitted',
            'remarks' => NULL
        ]);
        $log->save();

        // log
        activity('submitted')
            ->performedOn($this->order)
            ->log(':causer.name submitted an order :subject.order_number');

    }

    public function cancelOrder() {
        $this->order->update([
            'status' => 'cancelled'
        ]);

        // order log
        $log = new OrderLog([
            'order_id' => $this->order->id,
            'user_id' => auth()->user()->id,
            'status' => 'cancelled',
            'remarks' => NULL
        ]);
        $log->save();

        // log
        activity('cancelled')
            ->performedOn($this->order)
            ->log(':causer.name cancelled an order :subject.order_number');
    }

    public function reOrder() {
        Session::put('re-order-data', $this->order);

        return redirect()->route('order.create');
    }

    public function completeOrder() {
        $this->order->update([
            'status' => 'completed'
        ]);

        // order log
        $log = new OrderLog([
            'order_id' => $this->order->id,
            'user_id' => auth()->user()->id,
            'status' => 'completed',
            'remarks' => NULL
        ]);
        $log->save();

        // log
        activity('completed')
            ->performedOn($this->order)
            ->log(':causer.name completed an order :subject.order_number');
    }
}
