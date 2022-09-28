<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldTeamToPoTrackingNonmsHuaweiItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_huawei_item', function (Blueprint $table) {
            $table->integer('coordinator_id')->nullable();
            $table->integer('field_team_id')->nullable();
            $table->text('scoope_of_work')->nullable();
            $table->string('bast_number',100)->nullable();
            $table->date('bast_date')->nullable();
            $table->string('works',255)->nullable();
            $table->integer('client_project_id')->nullable();
            $table->string('gr_number',100)->nullable();
            $table->date('gr_date')->nullable();
            $table->integer('extra_budget')->nullable();
            $table->text('extra_budget_file')->nullable();
            $table->integer('vat_amount')->nullable();
            $table->integer('total_price_after_vat')->nullable();
            $table->integer('wht_amount')->nullable();
            $table->integer('total_invoice')->nullable();
            $table->text('acceptance_file')->nullable();
            $table->text('invoice_file')->nullable();
            $table->boolean('status_extra_budget')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_nonms_huawei_item', function (Blueprint $table) {
            //
        });
    }
}
