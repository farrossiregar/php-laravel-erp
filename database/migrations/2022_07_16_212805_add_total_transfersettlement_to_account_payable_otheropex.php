<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalTransfersettlementToAccountPayableOtheropex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable_otheropex', function (Blueprint $table) {
            $table->char('total_settlement', 30)->nullable();
            $table->char('employee_id', 30)->nullable();
            $table->string('app_staff_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable_otheropex', function (Blueprint $table) {
            //
        });
    }
}
