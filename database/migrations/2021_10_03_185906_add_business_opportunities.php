<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessOpportunities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_opportunities', function (Blueprint $table){
            $table->id();
            $table->string('customer',150)->nullable();
            $table->string('project_name',150)->nullable();
            $table->string('region', 50)->nullable();
            $table->string('qty', 20)->nullable();
            $table->string('price_or_unit', 100)->nullable();
            $table->string('estimate_revenue', 100)->nullable();
            $table->string('duration', 100)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('brief_description', 250)->nullable();
            $table->date('date')->nullable();
            $table->string('customer_type', 250)->nullable();
            $table->string('sales_name', 250)->nullable();

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
        //
    }
}
