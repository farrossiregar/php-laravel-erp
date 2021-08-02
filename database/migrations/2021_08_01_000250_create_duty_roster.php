<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutyRoster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('duty_roster_master', function (Blueprint $table) {
            // $table->id();
            // $table->integer('status')->nullable();
            // $table->text('note')->nullable();
            // $table->timestamps();
        });

        Schema::create('duty_roster_detail', function (Blueprint $table) {
            $table->id();
            
            // $table->string('project',255)->nullable();
            // $table->string('tower_index',255)->nullable();
            // $table->string('site_id',255)->nullable();
            // $table->string('site_name',255)->nullable();
            // $table->string('ne_system',50)->nullable();
            // $table->string('site_address',255)->nullable();
            // $table->string('cluster',255)->nullable();
            // $table->string('sub_cluster',255)->nullable();
            // $table->string('region',20)->nullable();
            // $table->string('sub_region',20)->nullable();
            // $table->string('idpel_pln',20)->nullable();
            // $table->string('lat',20)->nullable();
            // $table->string('long',20)->nullable();
            // $table->string('category_site',20)->nullable();
            // $table->integer('depedency',10)->nullable();
            // $table->string('pm_category',20)->nullable();
            // $table->string('macro_ibc_mcp_repeater',20)->nullable();
            // $table->string('site_type',20)->nullable();
            // $table->integer('permanent_genset',10)->nullable();
            // $table->string('tower_owner',10)->nullable();
            // $table->integer('sm_id')->nullable();
            // $table->string('sm_no1', 15)->nullable();
            // $table->string('sm_no2', 15)->nullable();
            // $table->integer('coordinator_id')->nullable();
            // $table->string('coordinator_no1', 15)->nullable();
            // $table->string('coordinator_no2', 15)->nullable();
            // $table->integer('te_id')->nullable();
            // $table->string('te_no1', 15)->nullable();
            // $table->string('te_no2', 15)->nullable();
            // $table->integer('cme_id')->nullable();
            // $table->string('cme_no1', 15)->nullable();
            // $table->string('cme_no2', 15)->nullable();
            // $table->string('collo_type', 30)->nullable();
            // $table->integer('rectifikasi1_id')->nullable();
            // $table->string('rectifikasi1_no1', 15)->nullable();
            // $table->string('rectifikasi1_no2', 15)->nullable();
            // $table->integer('rectifikasi2_id')->nullable();
            // $table->string('rectifikasi2_no1', 15)->nullable();
            // $table->string('rectifikasi2_no2', 15)->nullable();



            // $table->date('date')->nullable();
            // $table->text('rincian_kronologis')->nullable();
            
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
        Schema::dropIfExists('duty_roster');
    }
}
