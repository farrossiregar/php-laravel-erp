<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitmentLetter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commitment_letter', function (Blueprint $table) {
            $table->id();
            // $table->char('company_name', 50)->nullable();
            // $table->char('project', 50)->nullable();
            // $table->char('region', 30)->nullable();
            // $table->char('region_area', 30)->nullable();
            // $table->char('ktp_id', 16)->nullable();
            // $table->char('nik_pmt', 30)->nullable();
            // $table->char('leader', 30)->nullable();
            // $table->char('employee_name', 50)->nullable();
            // $table->char('signing_status', 20)->nullable();
            // $table->char('pdf', 20)->nullable();
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
        Schema::dropIfExists('commitment_letter');
    }
}
