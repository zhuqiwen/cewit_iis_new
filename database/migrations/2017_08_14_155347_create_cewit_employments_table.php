<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCewitEmploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cewit_employments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('alum_id');
            $table->unsignedInteger('organization_id');
            $table->string('job_title')->nullable();
            $table->string('job_type')->comment('fulltime, parttime, contractor, unknown')->nullable();
            $table->string('career_field')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
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
        Schema::dropIfExists('cewit_employments');
    }
}
