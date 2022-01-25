<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAssetDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_database', function (Blueprint $table) {
            $table->char('serial_number', 30)->nullable();
            // $table->char('location', 30)->nullable();
            $table->char('reason_request', 30)->nullable();
            $table->char('status', 10)->nullable();
            $table->char('note', 50)->nullable();
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
        Schema::table('asset_database', function (Blueprint $table) {
            //
        });
    }
}
