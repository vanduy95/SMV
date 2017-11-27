<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userinfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id')->unique();
            $table->integer('user_id')->unsigned()->index();
            $table->string('fullname')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->date('dateissue')->nullable();
            $table->string('issuedby')->nullable();
            $table->double('salary')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('phone4')->nullable();
            $table->string('maritalstatus')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyinteger('sex')->nullable();
            $table->string('identitycard')->nullable();
            $table->integer('assess_id')->unsigned()->index();
            $table->foreign('assess_id')->references('id')->on('assess')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('identitycard_image')->nullable();
            $table->string('household_image')->nullable();
            $table->string('bill_image')->nullable();
            $table->string('other_image')->nullable();
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
        Schema::dropIfExists('userinfo');
    }
}
