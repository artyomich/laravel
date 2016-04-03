<?php
/* 
  Seed data database table order_items for testing
 */
use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('order_items')->delete();

        OrderItem::create(array(
            'order_id' => '1',
            'product_id' => '1',
            'price' => '1000',
            'quantity' => '4'
        ));

        OrderItem::create(array(
            'order_id' => '1',
            'product_id' => '2',
            'price' => '2000',
            'quantity' => '4'
        ));

        OrderItem::create(array(
            'order_id' => '2',
            'product_id' => '3',
            'price' => '3000',
            'quantity' => '1'
        ));
        OrderItem::create(array(
            'order_id' => '2',
            'product_id' => '1',
            'price' => '1000',
            'quantity' => '2'
        ));
        OrderItem::create(array(
            'order_id' => '3',
            'product_id' => '1',
            'price' => '1000',
            'quantity' => '2'
        ));
    }    

}
