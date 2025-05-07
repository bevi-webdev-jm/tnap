<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_arr = [
            [
                'stock_code'    => 'KS99074',
                'description'   => 'KS 45G BUY 12 GET PHP70 OFF',
                'price'         => 200.00,
            ],
            [
                'stock_code'    => 'KS99078',
                'description'   => 'KS 65GX2 BUY 5 GET PHP65 OFF',
                'price'         => 200.00,
            ],
            [
                'stock_code'    => 'KS99076',
                'description'   => 'KS 65GX3 BUY 3 GET PHP31 OFF',
                'price'         => 200.00,
            ],
            [
                'stock_code'    => 'KS99077',
                'description'   => 'KS 100GX3 BUY 2 GET PHP52 OFF',
                'price'         => 200.00,
            ],
        ];

        foreach($product_arr as $data) {
            $product = new Product([
                'stock_code' => $data['stock_code'],
                'description' => $data['description'],
                'price' => $data['price']
            ]);
            $product->save();
        }
    }
}
