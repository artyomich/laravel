<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeightDistanceToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->integer('delivery_price')->unsigned()->after('comment');
            $table->var_char('receiver_city_id',255)->after('quantity');
            $table->decimal('weight',8,2)->after('receiver_city_id');
            $table->decimal('volume',8,2)->after('weight');
            $table->integer('distance')->unsigned()>after('volume');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
               $table->dropColumn('quantity');
               $table->dropColumn('weight');
               $table->dropColumn('volume');
               $table->dropColumn('distance');
        });
    }
}
