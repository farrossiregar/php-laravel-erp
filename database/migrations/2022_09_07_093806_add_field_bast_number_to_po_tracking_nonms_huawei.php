<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldBastNumberToPoTrackingNonmsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_huawei', function (Blueprint $table) {
            $table->string('bast_number',100)->nullable();
            $table->date('bast_date')->nullable();
            $table->string('works',255)->nullable();
            $table->integer('client_project_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_nonms_huawei', function (Blueprint $table) {
            //
        });
    }
}
