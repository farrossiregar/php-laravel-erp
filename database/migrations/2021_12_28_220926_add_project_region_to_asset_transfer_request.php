<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProjectRegionToAssetTransferRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_transfer_request', function (Blueprint $table) {
            $table->char('project', 30)->nullable();
            $table->char('client_project_id', 10)->nullable();
            $table->char('region', 30)->nullable();
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
