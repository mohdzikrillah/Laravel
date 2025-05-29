<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaction::create([
            'order_number'=> 'ORD-8655',
            'customer_id' => 2,
            'book_id'=>3,
            'total_amount'=>200000.00,
        ]);

        Transaction::create([
            'order_number'=> 'ORD-00005',
            'customer_id' => 1,
            'book_id'=>2,
            'total_amount'=>240000.00,
        ]);
    }
}
