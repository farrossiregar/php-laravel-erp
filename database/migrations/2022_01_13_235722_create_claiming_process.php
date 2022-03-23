<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimingProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claiming_process', function (Blueprint $table) {
            $table->id();
            $table->char('ticket_id', 20)->nullable();
            $table->char('claim_category', 20)->nullable();
            $table->char('status', 20)->nullable();
            $table->char('note', 100)->nullable();
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
        Schema::dropIfExists('claiming_process');
    }
}
