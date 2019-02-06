<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('career_id')->unsigned();
            $table->foreign('career_id')->references('id')->on('careers');
            $table->integer('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('people');
            $table->string('level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void ..
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
