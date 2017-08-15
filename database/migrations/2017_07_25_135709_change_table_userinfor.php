<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTableUserinfor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userinfo', function (Blueprint $table) {
            $table->renameColumn('type_indentifycation', 'type_identifycation');
             $table->renameColumn('indentifycation_number', 'identifycation_number');
             $table->renameColumn('dateissue_indemtifycation', 'dateissue_identifycation');
             $table->renameColumn('issuedby_indemtifycation', 'issuedby_identifycation');
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
