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
            'weight' => '40',
            'distance' => '168'
        ));

        Order::create(array(
            'id' => '2',
            'user_id' => '1',
            'total' => '7200',
            'comment' => 'Есть в наличие?',
            'weight' => '80',
            'distance' => '568'
        ));

        Order::create(array(
            'id' => '3',
            'user_id' => '1',
            'total' => '1000',
            'comment' => 'Когда отправите?',
            'weight' => '80',
            'distance' => '269'
        ));
    }

}
