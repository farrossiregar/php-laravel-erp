<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetTransferRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_transfer_request', function (Blueprint $table) {
            $table->id();
            $table->char('id_asset_request', 30)->nullable();
            $table->char('transfer_from', 30)->nullable();
            $table->char('transfer_to', 30)->nullable();
            $table->char('transfer_reason', 100)->nullable();
            $table->char('status', 100)->nullable();
            $table->char('note', 100)->nullable();
            $table->char('amount_transfer', 100)->nullable();
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
        Schema::dropIfExists('asset_transfer_request');
    }
}
