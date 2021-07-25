<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFieldnocEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function(Blueprint $table){
            $table->string('cluster',30)->nullable();
            $table->string('project',100)->nullable();
            $table->char('telepon3', 25)->after('telepon')->nullable();
            $table->char('telepon2', 25)->after('telepon')->nullable();
            $table->string('emergency_contact', 50)->nullable();
            $table->char('emergency_number', 25)->nullable();
            $table->date('resign_date')->after('join_date')->nullable();
            $table->date('contract_end')->nullable();
            $table->string('resignation_reason',100)->nullable();
            $table->string('account_name',100)->nullable();
            $table->string('bank_name',100)->nullable();
            $table->string('account_number',100)->nullable();
            $table->string('postcode',10)->after('address')->nullable();
            $table->string('domisili',100)->after('address')->nullable();
            $table->string('tax_status',20)->nullable();
            $table->string('mothers_name',30)->nullable();
            $table->string('bpjs_jht',50)->after('bpjs_number')->nullable();
            $table->string('bpjs_pensiun',50)->after('bpjs_number')->nullable();
            $table->string('education_level',20)->nullable();
            
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
