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
        $order->receiver_city_id = Input::get("receiver_city_id");
        $this->recalculateDelivery($order);
        return $this->orderToJson($order);
    }

    private function recalculateDelivery($order) {
        $receiverCityId = $order->receiver_city_id;
        if ($receiverCityId) {
            $calc = new CalculatePriceDeliveryCdek();
            $calc->setSenderCityId('270');
            $calc->setReceiverCityId($receiverCityId);
            $calc->setDateExecute('2016-02-01');
            $calc->setTariffId('137');
            $calc->setModeDeliveryId('3');
            $totalWeight = 0;
            $totalPrice = 0;
            foreach ($order->items as $item) {
                for ($i = 0; $i < $item->quantity; $i++) {
                    $calc->addGoodsItemByVolume($item->product->weight, 0.3);
                }
                $totalWeight += $item->product->weight * $item->quantity;
                $totalPrice += $item->product->price * $item->quantity;
            }
            $order->weight = $totalWeight;
            if ($calc->calculate() === true) {
                $res = $calc->getResult();
                $order->delivery_price = $res['result']['price'];
            } else {
                $f = fopen("/tmp/log.txt", "a");
                fwrite($f, print_r($calc->getError(), true));
                fwrite($f, "\n");
                fclose($f);
            }
            $order->total = $order->delivery_price + $totalPrice;
            $order->save();
        }
    }

    public function index($id) {
        $order = Order::where('id', '=', $id)
                        ->where('user_id', '=', Auth::user()->id)->first();
        $this->recalculateDelivery($order);
        return $this->orderToJson($order);
    }

    public function show($id) {
        $data = [
            'order' => Order::findOrFail($id)
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

        $order->items()->delete($itemId);

        $this->recalculateDelivery($order);

        return $this->orderToJson($order);
    }

}
