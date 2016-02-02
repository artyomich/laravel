<?php

/*
  Seed data database table orders for testing
 */

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder {

    public function run() {
        DB::table('orders')->delete();

        Order::create(array(
            'id' => '1',
            'user_id' => '1',
            'total' => '4000',
            'comment' => 'Позвоните мне.',
            'delivery_price' => '1200',
            'quantity' => '1',
            'weight' => '40',
            'distance' => '168',
            'volume' => '50'
        ));

        Order::create(array(
            'id' => '2',
            'user_id' => '1',
            'total' => '7200',
            'comment' => 'Есть в наличие?',
            'delivery_price' => '1200',
            'weight' => '80',
            'distance' => '568',
            'volume' => '50'
        ));

        Order::create(array(
            'id' => '3',
            'user_id' => '1',
            'total' => '1000',
            'comment' => 'Когда отправите?',
            'delivery_price' => '1200',
            'quantity' => '1',
            'distance' => '269',
            'weight' => '50',
            'volume' => '50'
        ));
    }

}
