<?php

namespace App\Livewire\Orders;

use Livewire\Component;

use App\Models\OrderLog;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class Show extends Component
{
    public $order;

    public $status_arr = [
        'draft'             => 'secondary',
        'submitted'         => 'info',
        'cancelled'         => 'danger',
        'payment received'  => 'primary',
        'released'          => 'success',
    ];

    public $product_images_arr = [
        'KS99074' => 'images/45G.png',
        'KS99078' => 'images/65GX2.jpg',
        'KS99076' => 'images/65GX3.png',
        'KS99077' => 'images/100GX3.jpg',
    ];

    public function render()
    {
        $approval_dates = OrderLog::select(DB::raw('DATE(created_at) as date'))
            ->where('order_id', $this->order->id)
            ->groupBy('date')
            ->orderByDesc('date')
            ->paginate(5, ['*'], 'order-log-page');

        // Fetch all logs in one query to avoid N+1
        $all_logs = OrderLog::with('user')
            ->where('order_id', $this->order->id)
            ->orderByDesc('created_at')
            ->get()
            ->groupBy(fn($log) => $log->created_at->toDateString());

        return view('livewire.orders.show', [
            'approval_dates' => $approval_dates,
            'approvals' => $all_logs,
        ]);
    }

    public function reOrder()
    {
        Session::put('re-order-data', $this->order);
        return redirect()->route('order.create');
    }

    public function updateOrderStatus(string $status): void
    {
        $this->order->update(['status' => $status]);

        OrderLog::create([
            'order_id' => $this->order->id,
            'user_id'  => auth()->id(),
            'status'   => $status,
            'remarks'  => null,
        ]);

        activity($status)
            ->performedOn($this->order)
            ->log(":causer.name {$status} an order :subject.order_number");
    }
}
