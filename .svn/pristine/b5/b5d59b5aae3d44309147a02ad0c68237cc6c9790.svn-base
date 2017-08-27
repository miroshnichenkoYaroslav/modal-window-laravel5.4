<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name', 500);
            $table->string('file_path', 2048);
            $table->integer('user_id')->unsigned();
            $table->integer('diagnostic_type_id')->unsigned();
            $table->integer('diagnostic_subject_id')->unsigned();
            $table->smallInteger('year')->unsigned();
            $table->date('exam_date');
            $table->string('status', 15)->default('loaded');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnostic_files');
    }
}
