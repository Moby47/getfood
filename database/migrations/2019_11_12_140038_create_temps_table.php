<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temps', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('foodId');
            $table->integer('vendorId');
            $table->string('vendorName');
            $table->integer('userId')->nullable();
            $table->string('tempId');
            $table->integer('qty');
            $table->string('amt');
            $table->string('foodName');
            $table->string('address')->nullable();
            $table->string('phone');
            $table->string('delivery')->nullable();

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
        Schema::dropIfExists('temps');
    }
}
