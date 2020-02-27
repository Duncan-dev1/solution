<?php

use App\Order_details;
use Illuminate\Database\Seeder;

class Order_detailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order_details::class, 10)->create();
    }
}