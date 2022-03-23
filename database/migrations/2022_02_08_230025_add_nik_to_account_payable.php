<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNikToAccountPayable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable', function (Blueprint $table) {
            $table->char('client_project_id', 20)->nullable();
            $table->char('company_id', 20)->nullable();
            $table->char('nik', 20)->nullable();
            $table->char('status', 20)->nullable();
            $table->char('note', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable', function (Blueprint $table) {
            //
        });
    }
}
