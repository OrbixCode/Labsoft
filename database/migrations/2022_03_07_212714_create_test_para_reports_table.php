<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestParaReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_para_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('report_id');
            $table->unsignedInteger('testpara_id');
            $table->string('test_result');
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
        Schema::dropIfExists('test_para_reports');
    }
}
