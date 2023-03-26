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
            $table->integer('current_timer')->nullable()->after('team2_score_pk');
            $table->string('current_round')->nullable()->after('current_timer');
        });
        Schema::table('stats', function (Blueprint $table) {
            $table->boolean('is_change_court')->nullable()->after('ball_goal_number_coord_y');
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
            $table->dropColumn('current_timer');
            $table->dropColumn('current_round');
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn('is_change_court');
        });
    }
};
