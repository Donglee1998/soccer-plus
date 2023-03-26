<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsIntoStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->boolean('is_action_additional')->nullable()->after('is_edit');
            $table->integer('ball_goal_action_goalkeeper_id')->nullable()->after('is_action_additional');
            $table->bigInteger('ball_goal_pk_round')->nullable()->after('ball_goal_action_goalkeeper_id');
            $table->bigInteger('account_level')->nullable()->after('ball_goal_pk_round');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn('is_action_additional');
            $table->dropColumn('ball_goal_action_goalkeeper_id');
            $table->dropColumn('ball_goal_pk_round');
            $table->dropColumn('account_level');
        });
    }
}
