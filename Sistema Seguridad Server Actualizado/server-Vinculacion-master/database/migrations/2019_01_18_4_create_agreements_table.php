<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id')->unsigned();
            $table->foreign('entity_id')->references('id')->on('entities');
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('state');
            $table->string('route_file1');
            $table->string('route_file2');
            $table->string('route_file3');
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
        Schema::dropIfExists('agreements');
    }
}
