<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_database', function (Blueprint $table) {
            $table->id();
            $table->char('asset_name', 30)->nullable();
            $table->char('asset_type', 10)->nullable();
            $table->char('stok', 10)->nullable();
            $table->char('region', 10)->nullable();
            $table->char('project', 10)->nullable();
            $table->char('company_id', 10)->nullable();
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
        Schema::dropIfExists('asset_database');
    }
}
