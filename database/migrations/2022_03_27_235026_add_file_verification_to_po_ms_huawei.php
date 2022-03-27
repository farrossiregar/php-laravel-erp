<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFileVerificationToPoMsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_ms_huawei', function (Blueprint $table) {
            $table->text('file_verification')->nullable();
            $table->text('acceptance_doc')->nullable();
            $table->text('invoice_doc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_ms_huawei', function (Blueprint $table) {
            //
        });
    }
}
