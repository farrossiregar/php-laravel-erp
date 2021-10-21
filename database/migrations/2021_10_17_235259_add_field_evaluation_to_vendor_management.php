<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldEvaluationToVendorManagement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_management', function (Blueprint $table) {
            $table->char('ci_hq', 50)->nullable()->after('general_information');
            $table->char('ci_branch', 50)->nullable()->after('general_information');
            $table->char('ci_complete_licence', 50)->nullable()->after('general_information');

            $table->char('ta_capability', 50)->nullable()->after('team_availability_capability');
            $table->char('ta_team_qty', 50)->nullable()->after('team_availability_capability');

            $table->char('tf_dop', 50)->nullable()->after('tools_facilities');
            $table->char('tf_warehouse', 50)->nullable()->after('tools_facilities');
            $table->char('tf_special_tools', 50)->nullable()->after('tools_facilities');
            $table->char('tf_generator', 50)->nullable()->after('tools_facilities');
            $table->char('tf_vehicle', 50)->nullable()->after('tools_facilities');
            $table->char('tf_laptop', 50)->nullable()->after('tools_facilities');

            $table->char('ehs_certificate', 50)->nullable()->after('ehs_quality_management');
            $table->char('ehs_documentation', 50)->nullable()->after('ehs_quality_management');
            $table->char('ehs_reporting', 50)->nullable()->after('ehs_quality_management');
            $table->char('ehs_training', 50)->nullable()->after('ehs_quality_management');
            $table->char('ehs_qualitymanagement', 50)->nullable()->after('ehs_quality_management');
            $table->char('ehs_project_management', 50)->nullable()->after('ehs_quality_management');
            $table->char('ehs_company_structure', 50)->nullable()->after('ehs_quality_management');
            
            $table->char('cc_special_requirement', 50)->nullable()->after('commercial_compliance');
            $table->char('cc_payment_term_compliance', 50)->nullable()->after('commercial_compliance');
            $table->char('cc_lead_time_compliance', 50)->nullable()->after('commercial_compliance');
            $table->char('cc_price_compliance', 50)->nullable()->after('commercial_compliance');
            
            
            
  
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
