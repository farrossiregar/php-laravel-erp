<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldAppStaffNoteToAccountPayablePettycash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable_pettycash', function (Blueprint $table) {
            $table->text('app_staff_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable_pettycash', function (Blueprint $table) {
            //
        });
    }
}
