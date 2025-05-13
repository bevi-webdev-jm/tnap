<?php

namespace App\Livewire\Orders;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Order;

use App\Http\Traits\SettingTrait;

class OrderList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    use SettingTrait;

    public $status_arr = [
        'draft'             => 'secondary',
        'submitted'         => 'info',
        'cancelled'         => 'danger',
        'payment received'  => 'primary',
        'released'          => 'success',
    ];

    public function render()
    {
        $orders = Order::orderBy('order_number', 'DESC')
            ->when(!auth()->user()->hasRole('superadmin') && !auth()->user()->hasRole('Admin') && !auth()->user()->hasRole('Release'), function($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->paginate($this->getDataPerPage(), ['*'], 'order-page');

        return view('livewire.orders.order-list')->with([
            'orders' => $orders
        ]);
    }
}
