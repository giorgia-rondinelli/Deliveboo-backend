<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Type;

class PageController extends Controller
{
    public function index(){
        $restaurants=Restaurant::with('dishes','types')->get();
        return response()->json($restaurants);
    }
    public function types(){
        $types=Type::with('restaurants')->get();
        return response()->json($types);
    }
    public function dishes(){
        $dishes=Dish::with('restaurant')->get();
        return response()->json($dishes);
    }
}
