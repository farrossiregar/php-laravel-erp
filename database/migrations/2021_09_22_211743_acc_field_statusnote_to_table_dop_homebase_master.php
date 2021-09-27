<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccFieldStatusnoteToTableDopHomebaseMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dop_homebase_master', function (Blueprint $table) {
            
            $table->string('note', 250)->nullable()->after('budget');
            $table->char('status', 10)->nullable()->after('budget');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_dop_homebase_master', function (Blueprint $table) {
            //
        });
    }
}
