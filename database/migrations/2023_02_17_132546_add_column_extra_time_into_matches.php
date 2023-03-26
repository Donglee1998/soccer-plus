<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->integer('additional_extra_time1')->nullable()->after('team2_ball_control');
            $table->integer('additional_extra_time2')->nullable()->after('additional_extra_time1');
            $table->integer('team1_score_pk')->nullable()->after('additional_extra_time2');
            $table->integer('team2_score_pk')->nullable()->after('team1_score_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->dropColumn('additional_extra_time1');
            $table->dropColumn('additional_extra_time2');
            $table->dropColumn('team1_score_pk');
            $table->dropColumn('team2_score_pk');
        });
    }
};
