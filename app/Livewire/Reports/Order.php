<?php

namespace App\Livewire\Reports;

use Livewire\Component;

use App\Models\Order as OrderModel;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrderExport;

class Order extends Component
{
    public $date;

    public function render()
    {
        // Product order summary
        $orderDetails = DB::table('order_details as od')
            ->select(
                'p.stock_code',
                'p.description',
                DB::raw('SUM(od.quantity) as total_quantity'),
                DB::raw('SUM(od.amount) as total_amount')
            )
            ->leftJoin('products as p', 'p.id', '=', 'od.product_id')
            ->groupBy('p.stock_code', 'p.description')
            ->when(!empty($this->date), function($query) {
                $query->leftJoin('orders as o', 'o.id', '=', 'od.order_id')
                    ->where('o.order_date', $this->date);
            })
            ->get();

        $chartData = $orderDetails->map(fn($item) => [
            'name' => $item->description,
            'y' => (float) $item->total_amount,
            'x' => (float) $item->total_quantity,
        ]);

        $this->dispatch('update-chart', data: $chartData);

        // Total unique customers
        $totalCustomer = OrderModel::distinct('customer_name')
            ->when(!empty($this->date), function($query) {
                $query->where('order_date', $this->date);
            })
            ->count('customer_name');

        // Business associate (BA) total sales
        $baSales = DB::table('orders as o')
            ->select('u.name', DB::raw('SUM(o.total) as total_amount'))
            ->leftJoin('users as u', 'u.id', '=', 'o.user_id')
            ->when(!empty($this->date), function($query) {
                $query->where('o.order_date', $this->date);
            })
            ->groupBy('u.name')
            ->get();

        $chartBaData = $baSales->map(fn($item) => [
            'name' => $item->name,
            'y' => (float) $item->total_amount,
        ]);

        // Payment type totals
        $paymentTypes = DB::table('order_payment_types as apt')
            ->select(
                'type',
                DB::raw('SUM(total) as total_amount')
            )
            ->leftJoin('orders as o', 'o.id', '=', 'apt.order_id')
            ->leftJoin('payment_types as pt', 'pt.id', '=', 'apt.payment_type_id')
            ->when(!empty($this->date), function($query) {
                $query->where('order_date', $this->date);
            })
            ->groupBy('type')
            ->get();

        $paymentTypeData = $paymentTypes->map(fn($item) => [
            'name' => $item->type,
            'y' => (float) $item->total_amount,
        ]);

        $order_status_data = DB::table('orders')
            ->select(
                'status',
                DB::raw('count(status) as total')
            )
            ->when(!empty($this->date), function($query) {
                $query->where('order_date', $this->date);
            })
            ->groupBy('status')
            ->get();
        
        return view('livewire.reports.order')->with([
            'chart_data' => $chartData,
            'total_customer' => $totalCustomer,
            'chart_ba_data' => $chartBaData,
            'payment_type_data' => $paymentTypeData,
            'order_status_data' => $order_status_data
        ]);
    }

    public function exportData() {
        return Excel::download(new OrderExport($this->date), 'Order data export-'.time().'.xlsx');
    }

}
