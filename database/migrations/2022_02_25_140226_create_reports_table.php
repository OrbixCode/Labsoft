<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('doctor_id')->nullable();
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('gender_id');
            $table->string('patient_name');
            $table->string('patient_age');
            $table->string('patient_contact');
            $table->string('time');
            $table->string('issue_date')->nullable();
            $table->string('report_image')->nullable();
            $table->longText('report_description')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('reports');
    }
}
