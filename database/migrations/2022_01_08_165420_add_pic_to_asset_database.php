<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPicToAssetDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asset_database', function (Blueprint $table) {
            $table->char('pic', 30)->nullable();
            $table->char('pic_telephone', 20)->nullable();
            $table->char('pic_bank_account', 30)->nullable();
            $table->char('dimension', 30)->nullable();
            $table->char('detail', 30)->nullable();
            $table->char('reference_pic', 30)->nullable();
            $table->char('link', 30)->nullable();

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
