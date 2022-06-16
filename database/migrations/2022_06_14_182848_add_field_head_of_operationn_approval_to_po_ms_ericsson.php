<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldHeadOfOperationnApprovalToPoMsEricsson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            $table->boolean('head_of_operation')->default(0)->nullable();
            $table->text('head_of_operation_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            //
        });
    }
}
