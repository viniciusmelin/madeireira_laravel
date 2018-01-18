<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\People;
use App\Order;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalCliente = People::has('client')->count();
        $totalPedidos = Order::all()->count();
        return view('home',compact('totalCliente','totalPedidos'));
    }
}
