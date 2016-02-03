<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class NewOrderController extends Controller
{
    private function orderToJson($order) {
        $items = array();
        foreach ($order->items as $item) {
            $data = $item->toArray();
            $data['product'] = $item->product;
            $items[] = $data;
        }
        $orderData = $order->toArray();
        $orderData['items'] = $items;
        return new Response($orderData);
    }
    
    public function index($id) {
        $product = Product::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();
        return $this->orderToJson($order);
    }
    
    protected function show($id)
    {
        $data = Product::all();
        return view('newOrder', $data);
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $itemId) {
        $product = Product::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();

        $order->items()->delete($itemId);

        $this->recalculateDelivery($order);

        return $this->orderToJson($order);
    }
}
