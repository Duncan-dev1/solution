<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OrdersSeeder::class);
        $this->call(Order_detailsSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(SuppliersSeeder::class);
        $this->call(Supplier_productsSeeder::class);
    }
}