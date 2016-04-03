<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Input;
use App\CDEK\CalculatePriceDeliveryCdek;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends AngController {

    public function quantity($id, $itemId) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();
        $orderItem = $order->items()->findOrFail($itemId);

        $orderItem->quantity = (int) Input::get("quantity");
        $orderItem->save();

        $this->recalculateDelivery($order);

        return $this->orderToJson($order);
    }
    
    public function add($id) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();
        //$orderItem = $order->items()->findOrFail($id);
        //$productId = $order->items()->findOrFail($itemId);
  
        $orderItem = $order->items()->where('product_id','=',(int) Input::get("product_id"))->first();
        
        
        if($orderItem){
            $orderItem->quantity += (int) Input::get("quantity");
            $orderItem->save();
        } else {
            $product = Product::findOrFail((int) Input::get("product_id"));    
        
            $orderItem = new OrderItem;
            $orderItem->order_id = $id;
            $orderItem->product_id = $product->id;
            $orderItem->price = $product->price;
            $orderItem->quantity = (int) Input::get("quantity");
            $orderItem->save();
        }
        $this->recalculateDelivery($order);

        return $this->orderToJson($order);
    }

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

    public function receiver($id) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();
        $order->receiver_city_id = (int) Input::get("receiver_city_id");
        $this->recalculateDelivery($order);
        return $this->orderToJson($order);
    }

    public function sender($id) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();
        $order->sender_city_id = (int) Input::get("sender_city_id");
        $this->recalculateDelivery($order);
        return $this->orderToJson($order);
    }


    private function recalculateDelivery($order) {
        $receiverCityId = $order->receiver_city_id;
        $senderCityId = $order->sender_city_id;
   
        if ($receiverCityId) {
           
            $calc = new CalculatePriceDeliveryCdek();
            $calc->setSenderCityId($senderCityId);
            $calc->setReceiverCityId($receiverCityId);
            $calc->setDateExecute(date("Y-m-d"));
            $calc->setTariffId('1');
         
            foreach ($order->items as $item) {
                for ($i = 0; $i < $item->quantity; $i++) {
                    $calc->addGoodsItemBySize($item->product->weight/100, $item->product->length, $item->product->width, $item->product->height);
                }
            }
     
            if ($calc->calculate() === true) {
                $res = $calc->getResult();
                $order->delivery_price = $res['result']['price'];
            } else {
                $f = fopen("/tmp/log.txt", "a+");
                fwrite($f, print_r($calc->getError(), true));
                fwrite($f, "\n");
                fclose($f);
            }
        }

        $totalWeight = 0;
        $totalVolume = 0;
        $totalPrice = 0;

        foreach ($order->items as $item) {
            $totalWeight += $item->product->weight * $item->quantity;
            $totalVolume += $item->product->width * $item->product->length * $item->product->height * $item->quantity / 1000000;
            $totalPrice += $item->product->price * $item->quantity;
        }

        $order->weight = $totalWeight;
        $order->volume = $totalVolume;

        $order->total = $order->delivery_price + $totalPrice;
        $order->save();
    }

    public function index($id) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();
        return $this->orderToJson($order);
    }

    public function show($id) {
        $data = [
            'order' => Order::findOrFail($id),
            'products' => Product::lists('name','id')
        ];
        return view('order.edit', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, $itemId) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();

        $order->items()->findOrFail($itemId)->delete();

        $this->recalculateDelivery($order);

        return $this->orderToJson($order);
    }

}
