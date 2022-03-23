<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransferIdToAssetTransferRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_transfer_request', function (Blueprint $table) {
            $table->char('transfer_id', 20)->nullable();
            $table->char('transfer_from_bank_account', 30)->nullable();
            $table->char('transfer_from_bank_name', 30)->nullable();
        });

        Schema::table('asset_database', function (Blueprint $table) {
            $table->char('pic_bank_name', 20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_transfer_request', function (Blueprint $table) {
            //
        });
    }
}
