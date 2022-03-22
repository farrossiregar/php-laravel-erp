<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldApprovalFileToPoMsHuawei extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_ms_huawei', function (Blueprint $table) {
            $table->text('approval_file')->nullable();
            $table->boolean('is_regional_reconciliation')->default(0)->nullable();
            $table->boolean('is_customer_gm')->default(0)->nullable();
            $table->boolean('is_customer_gh')->default(0)->nullable();
            $table->boolean('is_customer_od')->default(0)->nullable();
            $table->boolean('is_verification')->default(0)->nullable();
        });

        Schema::table('po_ms_ericsson', function (Blueprint $table) {
            $table->text('approval_file')->nullable();
            $table->boolean('is_regional_reconciliation')->default(0)->nullable();
            $table->boolean('is_customer_gm')->default(0)->nullable();
            $table->boolean('is_customer_gh')->default(0)->nullable();
            $table->boolean('is_customer_od')->default(0)->nullable();
            $table->boolean('is_verification')->default(0)->nullable();
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
