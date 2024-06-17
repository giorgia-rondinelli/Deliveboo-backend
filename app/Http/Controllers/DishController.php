<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\functions\Helper;
use App\Models\Restaurant;
use App\Models\Type;
use App\Models\Dish;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        $dishes = Dish::where('restaurant_id', $restaurant->id)->get();

        return view('admin.dishes.index', compact('dishes', 'restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        return view('admin.dishes.create', compact('restaurant'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        // dump($restaurant->id);
        // dd($request->all());

        $formData = $request->all();

        $newDish = new Dish();
        // aggiungo l' id del ristorante
        $newDish->restaurant_id = $restaurant->id;
        $newDish->fill($formData);
        dd($newDish);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
