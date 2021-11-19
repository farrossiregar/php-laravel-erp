<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCompanyIdToContractRegistrationFlow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_registration_flow', function (Blueprint $table) {
            $table->tinyInteger('company_id')->nullable();
            $table->integer('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contract_registration_flow', function (Blueprint $table) {
            //
        });
    }
}
