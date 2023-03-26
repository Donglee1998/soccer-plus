<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableActs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->integer('match_id');
            $table->integer('player');
            $table->tinyInteger('action_id');
            $table->tinyInteger('sub_action_id')->nullable();
            $table->string('position')->nullable()->comment('x,y');
            $table->boolean('result')->nullable();
            // $table->integer('order')->nullable();
            $table->tinyInteger('decision')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats');
    }
}
