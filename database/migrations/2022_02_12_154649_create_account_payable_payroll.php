<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPayablePayroll extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payable_payroll', function (Blueprint $table) {
            $table->id();
            $table->char('project_code', 30)->nullable();
            $table->char('project_name', 30)->nullable();
            $table->char('month', 20)->nullable();
            $table->char('year', 20)->nullable();
            $table->char('week', 20)->nullable();
            $table->char('employee_number', 20)->nullable();
            $table->char('basic_salary', 20)->nullable();
            $table->char('pulse_allowance', 30)->nullable();
            $table->char('position_allowance', 30)->nullable();
            $table->char('homebase_allowance', 30)->nullable();
            $table->char('transport_allowance', 30)->nullable();
            $table->char('motor_allowance', 30)->nullable();
            $table->char('overtime_allowance', 30)->nullable();
            $table->char('refund_pph21', 30)->nullable();
            $table->char('staff_claim', 30)->nullable();
            $table->char('incentive', 30)->nullable();
            $table->char('jamsostek_payable', 30)->nullable();
            $table->char('jamsostek_payable_jp', 30)->nullable();
            $table->char('bpjs_kesehatan', 30)->nullable();
            $table->char('pph21', 30)->nullable();
            $table->char('piutang', 30)->nullable();
            $table->char('own_risk', 30)->nullable();
            $table->char('unpaid_leave', 30)->nullable();
            $table->char('pinalty', 30)->nullable();
            $table->char('thp', 30)->nullable();            
            $table->char('cash_transaction_no', 100)->nullable();
            $table->char('attachment_hr', 50)->nullable();
            $table->char('account_no_recorded', 30)->nullable();
            $table->char('account_name_recorded', 30)->nullable();
            $table->char('nominal_recorded', 30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_payable_payroll');
    }
}
