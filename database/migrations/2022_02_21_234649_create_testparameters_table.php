<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestparametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testparameters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('testsetup_id');
            $table->string('test_parameter_name');
            $table->string('normal_range_male');
            $table->string('normal_range_female');
            $table->string('normal_range_infant');
            $table->string('test_unit');
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
        Schema::dropIfExists('testtypes');
    }
}
