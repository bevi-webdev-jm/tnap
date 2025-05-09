<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $payment_types_arr = [
            'CASH', 
            'GCASH', 
            'P-WALLET', 
            'DEBIT', 
            'CC', 
            'OTHERS',
        ];

        foreach($payment_types_arr as $type) {
            $type = new PaymentType([
                'type' => $type
            ]);
            $type->save();
        }
    }
}
