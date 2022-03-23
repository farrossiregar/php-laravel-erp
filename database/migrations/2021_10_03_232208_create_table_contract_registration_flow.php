<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableContractRegistrationFlow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_registration_flow', function (Blueprint $table) {
            $table->id();
            $table->string('id_bo', 20)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('contract', 100)->nullable();
            $table->string('project_code', 100)->nullable();
            $table->string('sub_project_code', 100)->nullable();
            $table->string('po_amount', 100)->nullable();
            $table->string('contract_duration', 100)->nullable();
            $table->date('start_contract')->nullable();
            $table->date('end_contract')->nullable();
            $table->string('remarks', 50)->nullable();
            $table->string('ca_tools_budget', 100)->nullable();
            $table->string('ca_vehicle_budget', 100)->nullable();
            $table->string('ca_resource_budget', 100)->nullable();
            $table->string('ca_office_base', 100)->nullable();
            $table->string('ca_opex_budget', 100)->nullable();
            $table->string('ca_timeline', 100)->nullable();
            $table->string('budget_preparation', 100)->nullable();
            $table->string('revenue', 100)->nullable();
            $table->string('resource_preparation', 100)->nullable();
            $table->string('kickof', 100)->nullable();
            $table->string('org_chart', 100)->nullable();
            $table->string('team_dimension', 100)->nullable();
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
        Schema::dropIfExists('table_contract_registration_flow');
    }
}
