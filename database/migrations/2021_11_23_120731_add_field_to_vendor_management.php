<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            // $table->string('main_customer_top_3',100)->nullable();
            // $table->string('government_clients_top_3',100)->nullable();
            // $table->string('other_customers',10)->nullable();
            // $table->string('2017_total_invoiced',10)->nullable();
            // $table->string('2018_total_invoiced',10)->nullable();
            // $table->string('2019_total_invoiced',10)->nullable();
            // $table->string('balance_2017',20)->nullable();
            // $table->string('balance_2018',20)->nullable();
            // $table->string('balance_2019',20)->nullable();
            // $table->text('notas_financial')->nullable();
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
