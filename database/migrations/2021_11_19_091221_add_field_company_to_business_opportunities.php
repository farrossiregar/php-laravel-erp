<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCompanyToBusinessOpportunities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('business_opportunities', function (Blueprint $table) {
            $table->tinyInteger('company_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->date('cancel_date')->nullable();
            $table->text('cancel_note')->nullable();
            $table->date('failed_date')->nullable();
            $table->text('failed_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('business_opportunities', function (Blueprint $table) {
            //
        });
    }
}
