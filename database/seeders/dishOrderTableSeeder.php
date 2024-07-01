<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Faker\Generator as Faker;

class dishOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
   $orders = Order::all();
    $usedCombinations = [];

    foreach ($orders as $order) {
        $restaurant = Restaurant::inRandomOrder()->first();
        $dishes = $restaurant->dishes;

        // Verifica che il ristorante abbia almeno 3 piatti
        if ($dishes->count() < 3) {
            continue;
        }

        for ($i = 0; $i < 3; $i++) {
            do {
                // Seleziona un piatto casuale dal ristorante
                $dish = $dishes->random();
                $combinationKey = $order->id . '-' . $dish->id;
            } while (isset($usedCombinations[$combinationKey]));

            $quantity = $faker->randomDigitNotNull();
            $dish->orders()->attach($order->id, ['dish_quantity' => $quantity]);
            $usedCombinations[$combinationKey] = true;
        }
    }
    }
}
