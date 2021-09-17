<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDopHomebaseMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dop_homebase_master', function (Blueprint $table) {
            $table->id();
            $table->char('remarks', 10)->nullable();
            $table->string('nama_dop', 100)->nullable();
            $table->string('project', 100)->nullable();
            $table->char('region', 50)->nullable();
            $table->string('alamat', 250)->nullable();
            $table->char('long', 50)->nullable();
            $table->char('lat', 50)->nullable();
            $table->char('pemilik_dop', 30)->nullable();
            $table->char('telepon_pemilik', 12)->nullable();
            $table->char('opex_region_ga', 20)->nullable();
            $table->char('type_homebase_dop', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_dop_homebase_master');
    }
}
