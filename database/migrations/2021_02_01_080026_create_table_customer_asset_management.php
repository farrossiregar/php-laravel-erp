<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCustomerAssetManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_asset_management', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->date('tanggal_submission')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('tower_id')->nullable();
            $table->integer('site_id')->nullable();
            $table->integer('region_cluster_id')->nullable();
            $table->string('region_name',100)->nullable();
            $table->integer('region_id')->nullable();
            $table->boolean('apakah_di_site_ini_ada_battery')->nullable();
            $table->smallInteger('berapa_unit')->nullable();
            $table->string('merk_baterai',100)->nullable();
            $table->string('kapasitas_baterai',10)->nullable();
            $table->date('kapan_baterai_dilaporkan_hilang')->nullable();
            $table->boolean('apakah_baterai_pernah_direlokasi')->nullable();
            $table->integer('direlokasi_ke_site_id')->nullable();
            $table->boolean('apakah_cabinet_baterai_dipasang_gembok')->nullable();
            $table->boolean('apakah_dipasang_baterai_cage')->nullable();
            $table->boolean('apakah_dipasang_cabinet_belting')->nullable();
            $table->text('catatan')->nullable();
            $table->text('check')->nullable();
            $table->boolean('smartsheet_done_submit')->nullable();
            $table->timestamps();
        });

        Schema::create('towers', function (Blueprint $table) {
            $table->id();
            $table->string('name',200)->nullable();
            $table->integer('site_id')->nullable();
            $table->timestamps();
        });

        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('site_id',100)->nullable();
            $table->string('name',200)->nullable();
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
        Schema::dropIfExists('customer_asset_management');
    }
}
