<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Order;
use Faker\Generator as Faker;

class dishOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $dishes = Dish::all();

        $orders = Order::all();


        foreach($dishes as $dish){
            $orderId = Order::inRandomOrder()->first();

            $quantity = $faker->randomDigitNotNull();

            $dish->orders()->attach($orderId, ['dish_quantity' => $quantity]);
        }

    }
}
