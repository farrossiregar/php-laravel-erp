<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestDetailOption extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_detail_option', function (Blueprint $table) {
            $table->id();
            $table->char('id_request_type', 5)->nullable();
            $table->char('request_type', 50)->nullable();
            $table->char('id_request_detail_option', 5)->nullable();
            $table->char('request_detail_option', 50)->nullable();
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
        Schema::dropIfExists('request_detail_option');
    }
}
