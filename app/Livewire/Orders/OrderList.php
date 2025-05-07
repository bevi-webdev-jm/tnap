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
        'draft'         => 'secondary',
        'submitted'     => 'info',
        'cancelled'     => 'danger',
        'completed'     => 'success',
    ];

    public function render()
    {
        $orders = Order::orderBy('order_number', 'DESC')
            ->paginate($this->getDataPerPage(), ['*'], 'order-page');

        return view('livewire.orders.order-list')->with([
            'orders' => $orders
        ]);
    }
}
