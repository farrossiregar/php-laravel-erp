<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorManagementEhs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_management_ehs', function (Blueprint $table) {
            $table->id();
            $table->char('id_supplier', 100)->nullable();
            $table->char('id_detail', 100)->nullable();
            $table->char('id_detail_title', 100)->nullable();
            $table->char('value', 100)->nullable();
            
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
        Schema::dropIfExists('vendor_management_ehs');
    }
}
