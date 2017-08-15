<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColunmTableUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userinfo', function (Blueprint $table) {
            $table->boolean('exchange_status')->nullable();
            $table->string('note1')->nullable();
            $table->string('note2')->nullable();
            $table->integer('type_indentifycation')->nullable();
            $table->string('time_worked')->nullable();
            $table->string('department')->nullable();
            $table->string('number_account')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('salary_avg')->nullable();
            $table->integer('salary_day')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userinfo', function (Blueprint $table) {
            //
        });
    }
}
