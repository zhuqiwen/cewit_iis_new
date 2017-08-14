<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCewitSponsorshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cewit_sponsorships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('organization_id')->nullable();
            $table->unsignedInteger('activity_id')->nullable();
            $table->unsignedInteger('contact_id')->nullable();
            $table->text('description')->comment('detail sponsorship forms, purpose')->nullable();
            $table->double('amount')->nullable();
            $table->string('purpose')->nullable();
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
        Schema::dropIfExists('cewit_sponsorships');
    }
}
