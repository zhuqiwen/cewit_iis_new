<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCewitStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cewit_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id');
            $table->string('title')->nullable();
            $table->string('department')->nullable();
            $table->string('school')->nullable();
            $table->string('school_code')->nullable();
            $table->boolean('is_cewit_staff')->nullable();
            $table->boolean('is_iuwit_member')->nullable();
            $table->boolean('is_advisory_council')->nullable();
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
        Schema::dropIfExists('cewit_staff');
    }
}
