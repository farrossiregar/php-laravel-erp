<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDetailTitleToVendorManagementGi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management_gi', function (Blueprint $table) {
            $table->char('id_detail_title', 100)->nullable()->after('id_detail_group');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_management_gi', function (Blueprint $table) {
            //
        });
    }
}
