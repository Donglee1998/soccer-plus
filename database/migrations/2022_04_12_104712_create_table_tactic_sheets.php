<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTacticSheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tactic_id')->unsigned();
            $table->string('sketch')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('layer')->nullable();
            $table->text('comment')->nullable();
            $table->tinyInteger('order')->nullable();
            $table->integer('coord_ball_x')->nullable();
            $table->integer('coord_ball_y')->nullable();
            $table->integer('coord_goal_x')->nullable();
            $table->integer('coord_goal_y')->nullable();
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
        Schema::dropIfExists('sheets');
    }
}
