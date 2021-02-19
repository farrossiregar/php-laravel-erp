<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStatusSubmit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('critical_case_detail', function (Blueprint $table) {
            $table->boolean('status_submit')->default(0)->nullable()->comment = '0=Waiting submit,1=>Submited';
            $table->boolean('type')->nullable()->comment='1=Repetitive, 2=Non Repetitive';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('critical_case_detail', function (Blueprint $table) {
            //
        });
    }
}
