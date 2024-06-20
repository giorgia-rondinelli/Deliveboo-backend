<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usedCombinations = [];
        $restaurants = Restaurant::all();

        foreach($restaurants as $restaurant){
            $type_id = Type::inRandomOrder()->first()->id;

            $combinationKey = $restaurant->id . '-' . $type_id;

            $usedCombinations[$combinationKey] = true;

            $restaurant->types()->attach($type_id);
        }

        for ($i = 0; $i < 35; $i++) {
            do {
                $restaurant = Restaurant::inRandomOrder()->first();
                $type_id = Type::inRandomOrder()->first()->id;

                $combinationKey = $restaurant->id . '-' . $type_id;

            } while (isset($usedCombinations[$combinationKey]) || $restaurant->types->count() === 3);

            $usedCombinations[$combinationKey] = true;

            $restaurant->types()->attach($type_id);
        }
    }
}
