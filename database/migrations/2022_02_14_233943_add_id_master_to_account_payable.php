<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdMasterToAccountPayable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('account_payable_subcont', function (Blueprint $table) {
            $table->char('id_master', 20)->nullable()->after('id');
        });

        Schema::table('account_payable_sitekeeper', function (Blueprint $table) {
            $table->char('id_master', 20)->nullable()->after('id');
        });

        Schema::table('account_payable_hqadministration', function (Blueprint $table) {
            $table->char('id_master', 20)->nullable()->after('id');
        });

        Schema::table('account_payable_payroll', function (Blueprint $table) {
            $table->char('id_master', 20)->nullable()->after('id');
        });

        Schema::table('account_payable_suppliervendor', function (Blueprint $table) {
            $table->char('id_master', 20)->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('account_payable', function (Blueprint $table) {
            //
        });
    }
}
