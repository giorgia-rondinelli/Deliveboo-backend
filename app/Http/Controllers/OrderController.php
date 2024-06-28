<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dish;
use App\Models\Restaurant;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recupera il ristorante dell'utente autenticato
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            // Gestisci il caso in cui il ristorante non esiste per l'utente autenticato
            return redirect()->route('admin.restaurants.create')->with('error', 'Restaurant not found');
        }

        // Recupera tutti gli ID dei piatti del ristorante
        $dishIds = Dish::where('restaurant_id', $restaurant->id)->pluck('id');

        // Recupera tutti gli ordini associati ai piatti del ristorante
        $auht_orders = Order::whereHas('dishes', function ($query) use ($dishIds) {
            $query->whereIn('dishes.id', $dishIds);
        })->get();

        // Ritorna la vista con gli ordini autorizzati
        return view('admin.orders.index', compact('auht_orders'));
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
    public function show($id)
    {
        // Recupera il ristorante dell'utente autenticato
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            // Gestisci il caso in cui il ristorante non esiste per l'utente autenticato
            return redirect()->route('admin.restaurants.create')->with('error', 'Restaurant not found');
        }

        // Recupera tutti gli ID dei piatti del ristorante
        $dishIds = Dish::where('restaurant_id', $restaurant->id)->pluck('id');

        // Recupera l'ordine specifico solo se contiene piatti del ristorante dell'utente autenticato
        $orderOne = Order::whereHas('dishes', function ($query) use ($dishIds) {
            $query->whereIn('dishes.id', $dishIds);
        })->with(['dishes' => function ($query) {
            $query->select('id', 'name', 'price')
                    ->withPivot('dish_quantity');
        }])->findOrFail($id);

        // Ritorna la vista con l'ordine
        return view('admin.orders.show', compact('orderOne','dishIds'));
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
