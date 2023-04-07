<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->Integer('product')->nullable();
            $table->Integer('user')->nullable();
            $table->Integer('supplier')->nullable();
            $table->Integer('category')->nullable();
            $table->Integer('brand')->nullable();
            $table->Integer('customer')->nullable();
            $table->string('pricing')->nullable();
            $table->string('currency_type')->nullable();
            $table->Integer('time')->nullable();
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
        Schema::dropIfExists('plans');
    }
}
