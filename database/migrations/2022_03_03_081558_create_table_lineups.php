<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLineups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineups', function (Blueprint $table) {
            $table->id();
            $table->integer('match_id');
            $table->integer('team_id');
            $table->string('title');
            $table->json('starting')->nullable();//order/number_official/number_practice,member_id
            $table->json('substitute')->nullable();
            $table->json('not_member')->nullable();
            // $table->tinyInteger('number_type')->nullable();//number_official/number_practice
            // $table->tinyInteger('type')->nullable()->comment('start/change');
            $table->tinyInteger('status')->nullable()->comment('active');
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
        Schema::dropIfExists('table_lineups');
    }
}
