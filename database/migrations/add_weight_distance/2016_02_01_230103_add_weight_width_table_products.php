<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeightWidthTableProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->decimal('weight',8,2)->after('price');
            $table->decimal('width',8,2)->after('weight');
            $table->decimal('length',8,2)->after('width');
            $table->decimal('height',8,2)->after('length');
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
               $table->dropColumn('weight');
               $table->dropColumn('width');
               $table->dropColumn('length');
               $table->dropColumn('height');
        });
    }
}
