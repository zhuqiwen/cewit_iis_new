<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCewitEmploymentSkillMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cewit_employment_skill_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employment_id');
            $table->unsignedInteger('skill_id');
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
        Schema::dropIfExists('cewit_employment_skill_mappings');
    }
}
