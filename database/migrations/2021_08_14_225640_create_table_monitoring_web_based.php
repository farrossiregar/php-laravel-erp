<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMonitoringWebBased extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monitoring_web_based', function (Blueprint $table) {
            $table->id();
            $table->string('department',150)->nullable();
            $table->string('sub_department',150)->nullable();
            $table->string('project_owner',150)->nullable();
            $table->text('business_process')->nullable();
            $table->string('status',50)->nullable();
            $table->timestamps();
        });

        Schema::create('monitoring_mobile_apps', function (Blueprint $table) {
            $table->id();
            $table->string('items',150)->nullable();
            $table->string('frequency',150)->nullable();
            $table->text('remark')->nullable();
            $table->string('status',15)->nullable();
            $table->string('web_report',15)->nullable();
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
        Schema::dropIfExists('monitoring_web_based');
    }
}
