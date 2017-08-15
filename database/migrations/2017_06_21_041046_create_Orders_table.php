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
        $table->string('name');
        $table->double('buy_now')->nullable();
        $table->string('product_reg')->nullable();
        $table->string('product_code')->nullable();
        $table->string('color')->nullable();
        $table->integer('price')->nullable();
        $table->double('prepay')->nullable();
        $table->double('select_rate')->nullable();
        $table->integer('lead_time')->nullable();
        $table->string('supmarket');
        $table->string('city');
        $table->string('district');
        $table->string('store');
        $table->string('salesman')->nullable();
        $table->integer('phonesale')->nullable();
        $table->integer('user_id')->unsigned()->index();
        $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        $table->integer('process_id')->unsigned()->index();
        $table->foreign('process_id')->references('id')->on('processstatus')->onDelete('cascade');
        $table->integer('retailsystem_id')->unsigned()->index();
        $table->foreign('retailsystem_id')->references('id')->on('retailsystem')->onDelete('cascade');
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
