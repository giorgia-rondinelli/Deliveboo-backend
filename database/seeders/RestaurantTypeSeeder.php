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
        for($i = 0; $i < 40; $i++){
            $restaurant = Restaurant::inrandomOrder()->first();

            $type_id = Type::inrandomOrder()->first()->id;

            $restaurant->types()->attach($type_id);
        }
    }
}
