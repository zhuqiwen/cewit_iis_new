<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCewitOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cewit_organizations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('website')->default('null')->nullable();
            $table->string('abbreviation')->default('null')->nullable();
            $table->string('sortable_name')->default('null')->nullable();
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
        Schema::dropIfExists('cewit_organizations');
    }
}
