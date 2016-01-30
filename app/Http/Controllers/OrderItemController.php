<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;

class OrderItemController extends BaseController
{
  public function edit($id) {
 //    public function index($id) {
     
       /*
        $order_items = [
            'orderItems' => OrderItem::all(),
            'products' => Product::all()
        ];
        //dd($order_items);
        */
       
     // return view('welcome');
      return Response::json(OrderItem::get());
     //return view('order.edit', $order_items);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        OrderItem::create(array(
            'quantity' => Input::get('quantity')
        ));
    
        //return Response::json(array('success' => true));
        return '';
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        OrderItem::destroy($id);
    
        //return Response::json(array('success' => true));
        return '';
    }
}