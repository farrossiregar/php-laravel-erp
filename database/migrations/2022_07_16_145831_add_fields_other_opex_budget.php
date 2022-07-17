<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsOtherOpexBudget extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('other_opex_budget', function(Blueprint $table){
            $table->char('region', 50)->nullable();
            $table->char('subregion', 50)->nullable();
            $table->char('company_id', 50)->nullable();
            $table->char('project', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
