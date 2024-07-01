<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\functions\Helper;
use App\Models\Order;
use Faker\Generator as Faker;


class ordersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for($i=0; $i<3000; $i++){
            $newOrder = new Order();
            $newOrder->name = $faker->name();
            $newOrder->slug = Helper::generateSlug($newOrder->name, Order::class);
            $newOrder->total_price = $faker->randomFloat(2, 10,200);
            $newOrder->address = $faker->streetAddress();
            $newOrder->phone_number = $faker->phoneNumber();
            $newOrder->e_mail = $faker->email();
            $newOrder->date = $faker->dateTimeBetween('-1 year');
            // dump($newOrder);
            $newOrder->save();
        }

    }
}
