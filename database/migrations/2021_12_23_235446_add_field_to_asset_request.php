<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToAssetRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_request', function (Blueprint $table) {
            $table->char('nik', 20)->nullable();
            $table->char('client_project_id', 10)->nullable();
            $table->char('dana_amount', 10)->nullable();
            $table->char('pr_no', 10)->nullable();
            $table->char('dana_from', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asset_request', function (Blueprint $table) {
            //
        });
    }
}
