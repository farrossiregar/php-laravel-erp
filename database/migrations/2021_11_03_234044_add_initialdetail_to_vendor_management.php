<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInitialdetailToVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            $table->char('initial_ci_hq', 50)->nullable()->after('initial_general_information');
            $table->char('initial_ci_branch', 50)->nullable()->after('initial_general_information');
            $table->char('initial_ci_complete_licence', 50)->nullable()->after('initial_general_information');

            $table->char('initial_ta_capability', 50)->nullable()->after('initial_team_availability_capability');
            $table->char('initial_ta_team_qty', 50)->nullable()->after('initial_team_availability_capability');

            $table->char('initial_tf_dop', 50)->nullable()->after('initial_tools_facilities');
            $table->char('initial_tf_warehouse', 50)->nullable()->after('initial_tools_facilities');
            $table->char('initial_tf_special_tools', 50)->nullable()->after('initial_tools_facilities');
            $table->char('initial_tf_generator', 50)->nullable()->after('initial_tools_facilities');
            $table->char('initial_tf_vehicle', 50)->nullable()->after('initial_tools_facilities');
            $table->char('initial_tf_laptop', 50)->nullable()->after('initial_tools_facilities');

            $table->char('initial_ehs_certificate', 50)->nullable()->after('initial_ehs_quality_management');
            $table->char('initial_ehs_documentation', 50)->nullable()->after('initial_ehs_quality_management');
            $table->char('initial_ehs_reporting', 50)->nullable()->after('initial_ehs_quality_management');
            $table->char('initial_ehs_training', 50)->nullable()->after('initial_ehs_quality_management');
            $table->char('initial_ehs_qualitymanagement', 50)->nullable()->after('initial_ehs_quality_management');
            $table->char('initial_ehs_project_management', 50)->nullable()->after('initial_ehs_quality_management');
            $table->char('initial_ehs_company_structure', 50)->nullable()->after('initial_ehs_quality_management');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            //
        });
    }
}
