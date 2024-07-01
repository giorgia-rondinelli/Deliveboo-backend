<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Dish;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DateTime;

class DashboardController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('user_id', Auth::id())->first();

        if (!$restaurant) {
            // Gestisci il caso in cui il ristorante non esiste per l'utente autenticato
            return redirect()->route('admin.restaurants.create')->with('error', 'Restaurant not found');
        }

        // Recupera tutti gli ID dei piatti del ristorante
        $dishIds = Dish::where('restaurant_id', $restaurant->id)->pluck('id');

        // Recupera tutti gli ordini associati ai piatti del ristorante
        $orders = Order::whereHas('dishes', function ($query) use ($dishIds) {
            $query->whereIn('dishes.id', $dishIds);
        })->orderBy('date', 'desc')->get();

        $lastOrders = Order::whereHas('dishes', function ($query) use ($dishIds) {
            $query->whereIn('dishes.id', $dishIds);
        })
        ->orderBy('date', 'desc')
        ->take(10) // Prende solo i primi 10 ordini
        ->get();

        $date = Carbon::now();
        $newDate = clone($date);
        $allDate = [];

        for($i = 0; $i < 12; $i++){
            $newDate = $newDate->subMonth();

            $newFormatDate = $newDate;

            $newFormatDate = $newFormatDate->format('M-Y');

            array_push($allDate, $newFormatDate);
        }

        $allDate = array_reverse($allDate);

        $totOrdersMonth = [];

        $totRevenueMonth = [];

        foreach($allDate as $oneDate){
            $totOrders = [];
            $totOrdersSales = 0;

            foreach($orders as $order){
                # Converti la stringa in un oggetto datetime
                $date_datetime = new DateTime($order->date);

                // Formatta la data secondo il formato desiderato
                $formatted_date = $date_datetime->format('M-Y');

                if($formatted_date == $oneDate){
                    array_push($totOrders, $order);
                    $totOrdersSales = $totOrdersSales + $order->total_price;
                }
            }

            $totOrdersCount = count($totOrders);

            array_push($totOrdersMonth, $totOrdersCount);
            array_push($totRevenueMonth, number_format($totOrdersSales, 2));
        }

        return view('admin.home', compact('orders', 'allDate', 'totOrdersMonth', 'totRevenueMonth', 'lastOrders'));
    }
}
