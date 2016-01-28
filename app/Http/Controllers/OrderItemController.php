<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemController extends Controller
{
  public function edit($id) {
     
        $order_items = [
            'order_items' => OrderItem::all(),
            'products' => Product::all()
        ];
        //dd($order_items);
        return view('order.edit', $order_items);
    }
}