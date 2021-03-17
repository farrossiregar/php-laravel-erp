<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSitesTechnologyTableSites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->string('site_technology',50)->nullable();
            $table->string('site_owner',20)->nullable();
            $table->string('tlp_company',150)->nullable();
            $table->string('site_category',50)->nullable();
            $table->string('site_type',50)->nullable();
            $table->string('regional',150)->nullable();
            $table->integer('sub_cluster_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            //
        });
    }
}
