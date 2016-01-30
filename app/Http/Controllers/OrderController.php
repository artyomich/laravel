<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    //
    protected function index()
    {
        //$orders = Order::all();
        //dd($orders);
        
        $orders = [
            'orders' => Order::all(),
            'count' => Order::count()
        ];
        return view('order.index', $orders);
    }
}