<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(){
        $restaurants=Restaurant::with('dishes','types')->get();
        foreach ($restaurants as $restaurant) {
            if ($restaurant->image) {
                $restaurant->image = Storage::url($restaurant->image);
            } else {
                $restaurant->image = Storage::url("img/placeholder.jpg");
            }
            foreach($restaurant->dishes as $dish){
                if ($dish->image) {
                    $dish->image = Storage::url($dish->image);
                } else {
                    $dish->image = Storage::url("img/placeholder.jpg");
                }
            }
        }


        return response()->json($restaurants);
    }
    public function types(){
        $types=Type::orderBy('name')->with('restaurants')->get();

        return response()->json($types);
    }
    public function dishes(){
        $dishes=Dish::with('restaurant')->get();
        return response()->json($dishes);
    }
}
