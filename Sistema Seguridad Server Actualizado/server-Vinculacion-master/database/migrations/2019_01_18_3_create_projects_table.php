<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->integer('coordinator_id')->unsigned();
            $table->foreign('coordinator_id')->references('id')->on('coordinators');
            $table->string('theme');
            $table->string('hours');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('route_file');
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
        Schema::dropIfExists('projects');
    }
}
