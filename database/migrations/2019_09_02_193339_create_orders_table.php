<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('foodId');
            $table->integer('vendorId');
            $table->string('vendorName');
            $table->integer('cusId');
            $table->string('cusName');
            $table->integer('qty');
            $table->integer('confirmation')->default(0);
            $table->string('title');
            $table->string('amt');
            $table->string('total');
            $table->string('ref');
            $table->string('trans');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('delivery');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
