<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = json_decode(file_get_contents(__DIR__ . '/restaurant.json'));

            $i = 1;
        foreach($restaurants as $restaurant){
            $newRestaurant = new Restaurant();
            $newRestaurant->user_id = $i;
            $newRestaurant->name = $restaurant->name;
            $newRestaurant->slug = Helper::generateSlug($newRestaurant->name, Restaurant::class);
            $newRestaurant->address = $restaurant->address;
            $newRestaurant->p_iva = $restaurant->p_iva;
            $newRestaurant->save();
            $i++;
            }
    }
}
