<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDailyCommitment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commitment_dailys', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->nullable();
            $table->text('device')->nullable();
            $table->boolean('regulasi_terkait_ppe_apd_menggunakan')->nullable();
            $table->text('regulasi_terkait_ppe_apd_tidak_punya')->nullable();
            $table->boolean('regulasi_terkait_sanksi')->nullable();
            $table->boolean('regulasi_terhadap_kecurian')->nullable();
            $table->boolean('regulasi_terhadap_kerusakan_nama_baik_perusahaan')->nullable();
            $table->boolean('regulasi_terkait_minuman_keras_obat_terlarang')->nullable();
            $table->boolean('regulasi_terkait_pelanggaran_peraturan_perusahaan')->nullable();
            $table->boolean('regulasi_terkait_protokol_kesehatan')->nullable();
            $table->boolean('regulasi_terkait_penggunaan_kendaraan')->nullable();
            $table->boolean('regulasi_bcg')->nullable();
            $table->boolean('regulasi_terkait_cyber_security')->nullable();
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
        Schema::dropIfExists('daily_commitments');
    }
}
