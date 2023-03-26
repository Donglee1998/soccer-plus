<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('abbreviation')->nullable();
            $table->tinyInteger('color_home')->nullable();
            $table->tinyInteger('color_guest')->nullable();
            $table->tinyInteger('gender')->nullable()->default(0)->comment('男子 女子 未選択');
            $table->string('hometown')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('coach')->nullable();
            $table->string('manager')->nullable();
            $table->string('trainer')->nullable();
            $table->text('explanation')->nullable();
            $table->integer('order')->nullable()->default(1);
            $table->tinyInteger('is_home')->nullable();
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
