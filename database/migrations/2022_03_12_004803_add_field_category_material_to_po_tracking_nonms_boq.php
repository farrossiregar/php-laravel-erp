<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldCategoryMaterialToPoTrackingNonmsBoq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('po_tracking_nonms_boq', function (Blueprint $table) {
            $table->string('category_material',200)->nullable();
            $table->string('sno_material',100)->nullable();
            $table->string('sno_rectification',100)->nullable();
            $table->string('po',100)->nullable();
            $table->string('po_line_item',100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('po_tracking_nonms_boq', function (Blueprint $table) {
            //
        });
    }
}
