<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DishRequest;
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
    public function store(DishRequest $request)
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        // dump($restaurant->id);

        $formData = $request->all();
        // Verifica se il checkbox è stato inviato nel form

        if (array_key_exists('image', $formData)) {

            $imagePath = Storage::put('uploads', $formData['image']);
            $originalName = $request->file('image')->getClientOriginalName();
            $formData['image_original_name'] = $originalName;
            $formData['image'] = $imagePath;
        }

        $newDish = new Dish();
        // aggiungo l' id del ristorante
        $newDish->restaurant_id = $restaurant->id;
        $newDish->fill($formData);
        $newDish->slug = Helper::generateSlug($newDish->name, dish::class);
        // dd($newDish);
        $newDish->save();

        return redirect()->route('admin.dishes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        if ($dish->restaurant_id !== Auth::user()->restaurant->id) {
            abort(404);
        } else {
            return view('admin.dishes.show', compact('dish'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();
        if ($dish->restaurant_id !== Auth::user()->restaurant->id) {
            abort(404);
        } else {
            return view('admin.dishes.edit', compact('restaurant', 'dish'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DishRequest $request, Dish $dish)
    {
        $formData = $request->all();


        if (array_key_exists('image', $formData)) {

            $imagePath = Storage::put('uploads', $formData['image']);
            $originalName = $request->file('image')->getClientOriginalName();
            $formData['image_original_name'] = $originalName;
            $formData['image'] = $imagePath;
        }


        $dish->update($formData);
        $dish->slug = Helper::generateSlug($dish->name, dish::class);
        // dd($dish);
        $dish->save();

        return redirect()->route('admin.dishes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {

        $dish->delete();

        return redirect()->route('admin.dishes.index');
    }
}
