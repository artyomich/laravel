<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        Eloquent::unguard();
      
        $this->call(OrdersTableSeeder::class);
        $this->command->info('Orders table seeded.');
  
        $this->call(OrderItemsTableSeeder::class);
        $this->command->info('Order_items table seeded.');
        
        $this->call(ProductsTableSeeder::class);
        $this->command->info('Products table seeded.');
    }
}
