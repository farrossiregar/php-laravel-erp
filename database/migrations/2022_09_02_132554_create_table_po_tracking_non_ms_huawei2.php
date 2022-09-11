<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePoTrackingNonMsHuawei2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_huawei_item', function (Blueprint $table) {
            $table->string('po_detail',200)->nullable();
            $table->string('po_aging',20)->nullable();
            $table->string('po_aging_by_category',20)->nullable();
            $table->string('po_aging_by_month',20)->nullable();
            $table->date('po_month_creation',20)->nullable();
            $table->integer('po_amount')->nullable();
            $table->string('project_code',100)->nullable();
            $table->string('region_code',100)->nullable();
            $table->string('account_drop_down',100)->nullable();
            $table->string('project_type',100)->nullable();
            $table->string('pr_no',100)->nullable();
            $table->date('date_of_req_pr')->nullable();
            $table->date('supplier',200)->nullable();
            $table->integer('pr_amount')->nullable();
            $table->string('margin',12)->nullable();
            $table->string('status_pr',25)->nullable();
            $table->index(['po_tracking_nonms_huawei_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_tracking_nonms_huawei');
    }
}
