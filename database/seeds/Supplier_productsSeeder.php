<?php

use App\Supplier_products;
use Illuminate\Database\Seeder;

class Supplier_productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Supplier_products::class, 10)->create();
    }
}