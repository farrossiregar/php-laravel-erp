<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToContractRegistrationFlow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contract_registration_flow', function (Blueprint $table) {
            $table->char('quotation_number', 30)->nullable()->after('id_bo');
            $table->char('po_number', 30)->nullable()->after('id_bo');
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
