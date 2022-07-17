<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCompanyIdToAccountPayableOtheropex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable_otheropex', function (Blueprint $table) {
            $table->integer('company_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('client_project_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable_otheropex', function (Blueprint $table) {
            //
        });
    }
}
