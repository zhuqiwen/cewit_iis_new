<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCewitContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cewit_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->index();
            $table->string('last_name')->index();
            $table->string('middle_name')->index()->nullable();
            $table->unsignedInteger('iuid')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->date('join_date')->nullable();
            $table->boolean('is_active')->default('1')->nullable();
            $table->string('is_affiliate')->default('1')->nullable();
            $table->string('is_test');
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
        Schema::dropIfExists('cewit_contacts');
    }
}
