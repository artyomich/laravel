<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    //
    protected function index()
    {
        //$orders = Order::all();
        //dd($orders);
        
        $data = [
            'orders' => Order::where('user_id', '=', Auth::user()->id)->get(),
            'count' => Order::count()
        ];
        return view('order.index', $data);
    }
    
    public function destroy($id) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();

        $order->delete($id);

        return $this->orderToJson($order);
    }
}