<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    function formatDollars($dollars)
    {
        return  number_format(sprintf('%0.2f', preg_replace("/[^0-9.]/", "", $dollars)), 2) . " EGP";
    }
    public function index()
    {
        $totalIncome = 0;
        $toalDelivery = 0;
        $netIncome = 0;

        $ordersCount = Order::where('status', '!=', 'canceled')->count();
        $orders = Order::where('status', '!=', 'canceled')->get();
        foreach ($orders as $order) {
            $totalIncome += $order->total_price;
            $toalDelivery += $order->delivery;
            $netIncome += $order->price;
        }

        return view('home', [
            'ordersCount' => $ordersCount,
            'delivery' => $this->formatDollars($toalDelivery),
            'income' => $this->formatDollars($totalIncome),
            'netIncome' => $this->formatDollars($netIncome)
        ]);
    }
}
