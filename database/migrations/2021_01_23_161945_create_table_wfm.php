<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWfm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_flow_management', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('name',100)->nullable();
            $table->string('id_',100)->nullable();
            $table->string('servicearea4',100)->nullable();
            $table->string('city',100)->nullable();
            $table->string('servicearea2',100)->nullable();
            $table->string('region',100)->nullable();
            $table->string('asp',10)->nullable();
            $table->string('region_dan_asp_info',50)->nullable();
            $table->string('skills',50)->nullable();
            $table->smallInteger('wo_assign')->nullable();
            $table->smallInteger('wo_accept')->nullable();
            $table->smallInteger('wo_close_manual')->nullable();
            $table->smallInteger('wo_close_auto')->nullable();
            $table->string('mttr',50)->nullable();
            $table->string('remark_wo_assign',150)->nullable();
            $table->string('remark_wo_accept',150)->nullable();
            $table->string('remark_wo_close_manual',150)->nullable();
            $table->text('final_remark')->nullable();
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
        Schema::dropIfExists('work_flow_management');
    }
}
