<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDutyrosterSitelistDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('dutyroster_sitelist_detail', function (Blueprint $table) {
            $table->id();
            
            $table->string('id_master_dutyroster', 255)->nullable();
            $table->string('project',255)->nullable();
            $table->string('tower_index',50)->nullable();
            $table->string('site_id',50)->nullable();
            $table->string('site_name',255)->nullable();
            $table->string('ne_system',50)->nullable();
            $table->string('site_address',255)->nullable();
            $table->string('cluster',30)->nullable();
            $table->string('sub_cluster',50)->nullable();
            $table->string('region',30)->nullable();
            $table->string('sub_region',50)->nullable();
            $table->string('idpel_pln',30)->nullable();
            

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
        Schema::dropIfExists('dutyroster_sitelist_detail');
    }
}
