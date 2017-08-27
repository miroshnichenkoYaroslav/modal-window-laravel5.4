<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_results', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('diagnostic_file_id')->unsigned();

            $table->integer('section_number')->unsigned()->nullable();

            $table->string('region_id')->nullable();
            $table->integer('municipality_id')->unsigned()->nullable();
            $table->integer('school_id')->unsigned()->nullable();

            $table->string('class', 10)->nullable();

            $table->integer('subject_id')->unsigned()->nullable();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();

            $table->boolean('presence')->nullable();

            $table->integer('total_result')->nullable();
            $table->text('xml_result')->nullable();

            $table->string('status')->nullable();
            $table->text('errors')->nullable();
            $table->text('duplicates')->nullable();

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
        Schema::dropIfExists('diagnostic_results');
    }
}
