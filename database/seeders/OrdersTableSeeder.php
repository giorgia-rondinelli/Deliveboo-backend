<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker ;

use App\functions\Helper;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i=0;$i<7; $i++){
            $new_order= new Order();
            $new_order->name=$faker->firstName();
            $new_order->slug=Helper::generateSlug($new_order->name, Order::class);
            $new_order->total_price=$faker->randomFloat(2, 5, 1000);
            $new_order->address=$faker->streetAddress();
            $new_order->phone_number=$faker->phoneNumber();



            $new_order->save();
        }
    }
}
