<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimingProcessLimit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claiming_process_limit', function (Blueprint $table) {
            $table->id();
            $table->char('user_access', 10)->nullable();
            $table->char('ticket_type', 10)->nullable();
            $table->char('claim_category', 10)->nullable();
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
        Schema::dropIfExists('claiming_process_limit');
    }
}
