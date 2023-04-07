<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit_id');
            $table->string('business_type')->nullable();
            $table->string('asset')->nullable();
            $table->string('status');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('currency')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('plan_id')->nullable();
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
        Schema::dropIfExists('agencies');
    }
}
