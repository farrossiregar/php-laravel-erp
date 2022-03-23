<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableVendorManagementGi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_management_gi', function (Blueprint $table) {
            $table->id();
            $table->char('id_supplier', 100)->nullable();
            $table->char('id_detail_group', 100)->nullable();
            $table->char('id_detail', 100)->nullable();
            $table->char('id_detail_title', 100)->nullable();
            $table->char('value', 250)->nullable();
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
        Schema::dropIfExists('table_vendor_management_gi');
    }
}
