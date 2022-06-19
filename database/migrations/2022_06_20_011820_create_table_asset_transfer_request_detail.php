<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAssetTransferRequestDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_transfer_request_detail', function (Blueprint $table) {
            $table->id();
            $table->char('user_id', 20)->nullable();
            $table->char('asset_id', 20)->nullable();
            $table->char('asset_name', 50)->nullable();

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
        Schema::dropIfExists('table_asset_transfer_request_detail');
    }
}
