<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldVendorManagementToVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            $table->string('supplier_npwp',50)->nullable();
            $table->string('owner_name',25)->nullable();
            $table->string('owner_ktp',50)->nullable();
            $table->string('owner_npwp',50)->nullable();
            $table->string('business_tdp',50)->nullable();
            $table->string('business_siup',50)->nullable();
            $table->string('business_npwp',50)->nullable();
            $table->string('commercial_name',25)->nullable();
            $table->string('commercial_phone',25)->nullable();
            $table->string('commercial_email',25)->nullable();
            $table->string('technical_name',25)->nullable();
            $table->string('technical_phone',25)->nullable();
            $table->string('technical_email',25)->nullable();
            $table->string('establish_year',6)->nullable();
            $table->text('hq_address')->nullable();
            $table->text('branch_address')->nullable();
            $table->string('telephone_office',25)->nullable();
            $table->smallInteger('initial_personal_licence_score')->nullable();
            $table->string('employee_quantity',5)->nullable();
            $table->string('high_level_manager',25)->nullable();
            $table->string('supervisor',25)->nullable();
            $table->string('engineer',25)->nullable();
            $table->string('technicians',25)->nullable();
            $table->string('administrative',25)->nullable();
            $table->string('finance_name',25)->nullable();
            $table->string('finance_position',25)->nullable();
            $table->string('finance_phone',25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            //
        });
    }
}
