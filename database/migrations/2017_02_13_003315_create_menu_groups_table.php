<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_group', function (Blueprint $table) {
            // $table->increments('id');
            $table->integer('id');
            $table->integer('groupuser_id')->unsigned()->index();
            $table->foreign('groupuser_id')->references('id')->on('groupuser')->onDelete('cascade');
            $table->integer('menu_id')->unsigned()->index();
            $table->foreign('menu_id')->references('id')->on('menu')->onDelete('cascade');
            $table->primary(['menu_id','groupuser_id']);
            $table->tinyinteger('value')->default('0');
            $table->tinyinteger('display')->default('0');
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
        Schema::dropIfExists('menu_group');
    }
}
