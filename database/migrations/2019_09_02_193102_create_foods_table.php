<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->string('vendor_name');
            $table->string('slug');
            $table->string('vendorAddress');
            $table->string('phone');
            $table->string('title');
            $table->string('amt');
            $table->string('unit')->nullable();
            $table->integer('qty');
            $table->integer('delivery')->nullable();
            $table->string('img');
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
        Schema::dropIfExists('foods');
    }
}
