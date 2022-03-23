<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsNoc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools_noc', function (Blueprint $table) {
            $table->id();
            $table->char('name', 50)->nullable();
            $table->char('nik', 20)->nullable();
            $table->char('tools', 30)->nullable();
            $table->char('software', 30)->nullable();
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
        Schema::dropIfExists('tools_noc');
    }
}
