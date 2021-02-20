<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTrackingPds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_tracking_pds', function (Blueprint $table) {
            $table->id();
            $table->string('project_name')->nullable();
            $table->string('subcontract_no')->nullable();
            $table->char('employers_name', 50)->nullable();
            $table->char('contract_no', 30)->nullable();
            $table->char('po_no', 30)->nullable();
            $table->char('subcontractors_name', 50)->nullable();

            $table->integer('project_quality_deduction_sum')->nullable();
            $table->string('project_quality_deduction_note')->nullable();
            $table->string('project_quality_deduction_description')->nullable();
            $table->integer('good_deduction_sum')->nullable();
            $table->string('good_deduction_note')->nullable();
            $table->string('good_deduction_description')->nullable();
            $table->integer('delay_work_deduction_sum')->nullable();
            $table->string('delay_work_deduction_note')->nullable();
            $table->string('delay_work_deduction_description')->nullable();
            $table->integer('dfpa_sum')->nullable();
            $table->string('dfpa_note')->nullable();
            $table->string('dfpa_description')->nullable();

            $table->integer('vat_sum')->nullable();
            $table->string('vat_note')->nullable();

            $table->integer('drafter')->nullable();
            $table->string('date')->nullable();

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
        Schema::dropIfExists('po_tracking_pds');
    }
}
