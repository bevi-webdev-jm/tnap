<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

use App\Models\Order;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public $date;

    public function __construct($date) {
        $this->date = $date;
    }

    public function headings(): array
    {
        return [
            ['ORDER DATA'], // Main Title (row 1)
            [
                'ORDER NUMBER',
                'ORDER DATE',
                'USER',
                'CUSTOMER NAME',
                'ADDRESS',
                'STATUS',
                'PAYMENT TYPE',
                'PAYMENT AMOUNT',
                'DESCRIPTION',
                'QUANTITY',
                'AMOUNT',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold the second row (the header row)
        return [
            2 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2']
                ],
                'alignment' => ['horizontal' => 'center']
            ],
            1 => [
                'font' => ['bold' => true, 'size' => 14],
                'alignment' => ['horizontal' => 'left']
            ]
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $rows = [];

        $orders = Order::orderBy('order_number', 'ASC')
            ->when(!empty($this->date), function ($query) {
                $query->where('order_date', $this->date);
            })
            ->get();

        foreach ($orders as $order) {
            $baseData = [
                $order->order_number,
                $order->order_date,
                $order->user->name ?? '',
                $order->customer_name,
                $order->address,
                $order->status,
            ];

            $payments = $order->order_payment_types;
            $products = $order->details;

            $productIndex = 0;

            foreach ($payments as $i => $payment) {
                $paymentType = $payment->payment_type->type ?? '';
                $paymentAmount = $payment->amount;

                $product = $products[$productIndex] ?? null;

                $rows[] = array_merge(
                    $i === 0 ? $baseData : array_fill(0, 6, ''),
                    [$paymentType, $paymentAmount],
                    $product ? [
                        $product->product->description ?? '',
                        $product->quantity,
                        $product->amount,
                    ] : ['', '', '', '']
                );

                $productIndex++;
            }

            for (; $productIndex < count($products); $productIndex++) {
                $product = $products[$productIndex];

                $rows[] = array_merge(
                    array_fill(0, 8, ''),
                    [
                        $product->product->description ?? '',
                        $product->quantity,
                        $product->amount,
                    ]
                );
            }
        }

        return new Collection($rows);
    }
}
