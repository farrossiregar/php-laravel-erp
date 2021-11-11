<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionTools extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_tools', function (Blueprint $table) {
            $table->id();
            $table->char('tools_name', 100)->nullable();
            $table->char('qty', 100)->nullable();
            $table->char('brand', 50)->nullable();
            $table->char('condition', 100)->nullable();
            $table->char('serial_number', 50)->nullable();
            $table->timestamps();
        });

        Schema::create('region_tools_history', function (Blueprint $table) {
            $table->id();
            $table->char('tools_name', 100)->nullable();
            $table->char('qty', 100)->nullable();
            $table->date('due_date')->nullable();
            $table->char('ft_pic', 100)->nullable();
            $table->char('ft_region', 50)->nullable();
            $table->char('condition', 100)->nullable();
            $table->date('date_borrow')->nullable();
            $table->date('date_return')->nullable();
            $table->char('status', 10)->nullable();
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
        Schema::dropIfExists('region_tools');
    }
}
