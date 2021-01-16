<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->nullable();
            $table->string('nik',100)->nullable();
            $table->string('place_of_birth',50)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->boolean('martial_status')->nullable()->comment = '1=Single,2=Married';
            $table->string('blood_type',4)->nullable();
            $table->string('email',100)->nullable();
            $table->date('join_date')->nullable();
            $table->boolean('employee_status')->nullable()->comment='1=Contract,2=Pegawai Tetap,3=Outsourching,4=Harian Lepas';
            $table->string('telepon',25)->nullable();
            $table->string('npwp_number',50)->nullable();
            $table->string('bpjs_number',50)->nullable();
            $table->string('religion',15)->nullable();
            $table->text('address')->nullable();
            $table->text('foto')->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
