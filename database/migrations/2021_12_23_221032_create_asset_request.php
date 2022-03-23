<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asset_request', function (Blueprint $table) {
            $table->id();
            $table->char('company_name', 6)->nullable();
            $table->char('project', 30)->nullable();
            $table->char('region', 30)->nullable();
            $table->char('name', 30)->nullable();
            $table->char('asset_type', 30)->nullable();
            $table->char('asset_name', 30)->nullable();
            $table->char('location', 30)->nullable();
            $table->char('dimension', 30)->nullable();
            $table->char('detail', 30)->nullable();
            $table->char('quantity', 30)->nullable();
            $table->char('reason_request', 30)->nullable();
            $table->char('reference_pic', 30)->nullable();
            $table->char('link', 30)->nullable();
            $table->char('status', 10)->nullable();
            $table->char('note', 50)->nullable();
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
        Schema::dropIfExists('asset_request');
    }
}
