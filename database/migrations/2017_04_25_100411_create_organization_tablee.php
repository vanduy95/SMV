<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationTablee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization', function (Blueprint $table) {
           $table->increments('id');
           $table->string('ma');
           $table->string('name')->nullable();
           $table->string('city')->nullable();
           $table->string('address')->nullable();
           $table->string('phone')->nullable();
           $table->string('bank')->nullable();
           $table->string('worker')->nullable();
           $table->tinyinteger('system');
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
        Schema::dropIfExists('organization');
    }
}
