<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCewitAcademicProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cewit_academic_programs', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('is_stem');
            $table->string('name');
            $table->string('primary_department')->nullable();
            $table->string('primary_school')->nullable();
            $table->string('secondary_department')->nullable();
            $table->string('secondary_school')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('cewit_academic_programs');
    }
}
