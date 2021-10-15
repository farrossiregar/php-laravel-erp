<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorManagementCreateProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_management_create_project', function (Blueprint $table) {
            $table->id();
            $table->char('project_name', 50)->nullable();
            $table->char('project_pic', 50)->nullable();
            $table->char('project_category', 50)->nullable();
            $table->char('supplier1_id', 50)->nullable();
            $table->char('supplier2_id', 50)->nullable();
            $table->char('supplier3_id', 50)->nullable();
            $table->char('note', 50)->nullable();
            $table->char('status', 50)->nullable();
            

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
        Schema::dropIfExists('vendor_management_create_project');
    }
}
