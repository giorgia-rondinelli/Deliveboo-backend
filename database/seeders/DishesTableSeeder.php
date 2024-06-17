<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;
use App\functions\Helper;
use App\Models\Restaurant;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '/dishes.json'));
        // dd($data);
        foreach ($data as $category) {
            // dd($dishes);
            foreach ($category as $dishData) {

                $newDish = new Dish();
                $newDish->restaurant_id = Restaurant::inRandomOrder()->first()->id;
                $newDish->name = $dishData->name;
                $newDish->slug = Helper::generateSlug($newDish->name, Dish::class);
                $newDish->description = $dishData->description;
                $newDish->price = $dishData->price;
                $newDish->is_visible = $dishData->is_visible ?? 1;
                $newDish->save();
            }
        }
        // dd($newDish);
    }
}
