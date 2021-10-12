<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_management', function (Blueprint $table) {
            $table->id();
            $table->char('supplier_name', 30)->nullable();
            $table->char('supplier_pic', 30)->nullable();
            $table->char('supplier_category', 30)->nullable();
            $table->char('supplier_registration_date', 30)->nullable();
            $table->char('status', 30)->nullable();
            $table->char('note', 30)->nullable();
            $table->char('legal', 100)->nullable();
            $table->char('org_chart', 100)->nullable();
            $table->char('tools_resource', 100)->nullable();
            $table->char('certification_resource', 100)->nullable();
            $table->char('scoring', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('supplier_selection', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('table_vendor_management');
    }
}
