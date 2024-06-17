<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Restaurant;

use Illuminate\Support\Facades\Auth;

use App\Models\Type;

use Illuminate\Support\Facades\Storage;

use App\functions\Helper;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::user()->id)->first();

        return view('admin.restaurant.index', compact('restaurant'));
        // dd($restaurant);



    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Restaurant $restaurant)
    {

        $types = Type::all();
        return view('admin.restaurant.edit', compact('restaurant', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $formData = $request->all();

        if(array_key_exists('image', $formData)){

            $imagePath = Storage::put('uploads', $formData['image']);
            $originalName = $request->file('image')->getClientOriginalName();
            $formData['image_original_name'] = $originalName;
            $formData['image']= $imagePath;

        }

        if ($formData['name']!==$restaurant->name) {
            $formData['slug'] = Helper::generateSlug($formData['name'], Restaurant::class);
        }else{
            $formData['slug']= $restaurant['slug'];
        }

        $restaurant->update($formData);

        if(array_key_exists('types', $formData)){
            $restaurant->types()->sync($formData['types']);
        }else{

            $restaurant->types()->detach();
        }

        return redirect()->route('admin.restaurants.index', $restaurant);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin')->with('success', 'Progetto eliminato correttamente');
    }
}