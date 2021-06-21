<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldLatLngToToolsCheckUpload extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tools_check_upload', function (Blueprint $table) {
            $table->string('lat',100)->nullable();
            $table->string('lng',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tools_check_upload', function (Blueprint $table) {
            //
        });
    }
}
