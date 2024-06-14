<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dish;

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
                // Crea un nuovo oggetto Dish
                $newDish = new Dish();
                $newDish->name = $dishData->name;
                $newDish->description = $dishData->description;
                $newDish->price = $dishData->price;
                $newDish->is_visible = $dishData->is_visible ?? 1; // Imposta
            }
        }
        dd($newDish);
    }
}
