<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testsetups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('test_name');
            $table->string('report_heading');
            $table->string('carry_out');
            $table->string('test_charge');
            $table->string('report_completion');
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
        Schema::dropIfExists('testsetups');
    }
}
