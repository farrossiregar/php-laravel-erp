<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorManagementTa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_management_ta', function (Blueprint $table) {
            $table->id();
            $table->char('id_supplier', 100)->nullable();
            $table->char('id_detail', 100)->nullable();
            $table->char('id_detail_title', 100)->nullable();
            $table->char('team', 100)->nullable();
            $table->char('eng', 100)->nullable();
            $table->char('tech', 100)->nullable();
            $table->char('rigger', 100)->nullable();
            $table->char('helper', 100)->nullable();
            $table->char('other', 100)->nullable();
            $table->char('year', 100)->nullable();
            $table->char('invoice', 100)->nullable();
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
        Schema::dropIfExists('vendor_management_ta');
    }
}
