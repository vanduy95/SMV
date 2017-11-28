<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddColumnUserinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userinfo', function (Blueprint $table) {
            $table->string('identitycard_image')->nullable();
            $table->string('household_image')->nullable();
            $table->string('bill_image')->nullable();
            $table->string('other_image')->nullable();
            $table->string('company')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('userinfo', function($table) {
            $table->dropColumn('identitycard_image');
            $table->dropColumn('household_image');
            $table->dropColumn('bill_image');
            $table->dropColumn('other_image');
            $table->dropColumn('company');
        });
    }
}
