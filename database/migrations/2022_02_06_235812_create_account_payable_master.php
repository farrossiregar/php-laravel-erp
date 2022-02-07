<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPayableMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_payable', function (Blueprint $table) {
            $table->id();
            $table->char('project', 30)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('name', 30)->nullable();
            $table->char('position', 30)->nullable();
            $table->char('department', 30)->nullable();
            $table->date('date')->nullable();
            $table->char('request_type', 30)->nullable();
            $table->char('subrequest_type', 30)->nullable();
            $table->char('additional_doc', 100)->nullable();
            $table->char('doc_name', 100)->nullable();
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
        Schema::dropIfExists('account_payable_master');
    }
}
