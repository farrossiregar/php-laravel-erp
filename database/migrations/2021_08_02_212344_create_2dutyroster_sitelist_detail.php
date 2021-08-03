<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create2dutyrosterSitelistDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dutyroster_sitelist_detail', function (Blueprint $table) {
            $table->string('lat',20)->nullable();
            $table->string('long',20)->nullable();
            $table->string('category_site',20)->nullable();
            $table->string('depedency',10)->nullable();
            $table->string('pm_category',10)->nullable();
            $table->string('macro_ibc_mcp_repeater',20)->nullable();
            $table->string('site_type',20)->nullable();
            $table->string('permanent_genset', 10)->nullable();
            $table->string('tower_owner',20)->nullable();
            $table->string('sm', 50)->nullable();
            $table->string('sm_no1', 15)->nullable();
            $table->string('sm_no2', 15)->nullable();
            $table->string('coordinator', 50)->nullable();
            $table->string('coordinator_no1', 15)->nullable();
            $table->string('coordinator_no2', 15)->nullable();
            $table->string('te', 50)->nullable();
            $table->string('te_no1', 15)->nullable();
            $table->string('te_no2', 15)->nullable();
            $table->string('cme', 50)->nullable();
            $table->string('cme_no1', 15)->nullable();
            $table->string('cme_no2', 15)->nullable();
            $table->string('collo_type', 30)->nullable();
            
            $table->string('rectifikasi1', 50)->nullable();
            $table->string('rectifikasi1_no1', 15)->nullable();
            $table->string('rectifikasi1_no2', 15)->nullable();
            $table->string('rectifikasi2', 50)->nullable();
            $table->string('rectifikasi2_no1', 15)->nullable();
            $table->string('rectifikasi2_no2', 15)->nullable();
            $table->string('rainy_session1', 50)->nullable();
            $table->string('rainy_session1_no1', 15)->nullable();
            $table->string('rainy_session1_no2', 15)->nullable();
            $table->string('rainy_session2', 50)->nullable();
            $table->string('rainy_session2_no1', 15)->nullable();
            $table->string('rainy_session2_no2', 15)->nullable();
            $table->string('digger', 50)->nullable();
            $table->string('digger_no1', 15)->nullable();
            $table->string('digger_no2', 15)->nullable();
            $table->string('waspan', 50)->nullable();
            $table->string('waspan_no1', 15)->nullable();
            $table->string('waspan_no2', 15)->nullable();
            $table->string('vehicle', 30)->nullable();
            $table->string('splicer', 30)->nullable();
            $table->string('otdr', 30)->nullable();
            $table->string('opm', 30)->nullable();
            $table->string('fo_cable_single72', 30)->nullable();
            $table->string('fo_cable_single36', 30)->nullable();
            $table->string('cable_fig8', 30)->nullable();
            $table->string('cable_72ribbon', 30)->nullable();
            $table->string('closure', 30)->nullable();
            $table->string('hdpe', 30)->nullable();
            $table->string('protection_sleeve', 30)->nullable();
            $table->string('bamboo', 30)->nullable();
            $table->string('po_in_out', 30)->nullable();
            $table->string('entity', 30)->nullable();
            $table->string('project_code', 30)->nullable();
            $table->string('remarks', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('2dutyroster_sitelist_detail');
    }
}
