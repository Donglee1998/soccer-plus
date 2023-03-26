<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnSync extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->json('team1_ball_control')->nullable()->after('status');
            $table->json('team2_ball_control')->nullable()->after('team1_ball_control');
        });

        Schema::table('lineups', function (Blueprint $table) {
            $table->tinyInteger('people_starting')->nullable()->after('pattern_name');
            $table->unsignedBigInteger('tmp_match_id')->nullable()->after('people_starting');
        });

        Schema::table('stats', function (Blueprint $table) {
            // $table->dropColumn('member_anonymous_id');
            // $table->dropColumn('action_created');
            // $table->dropColumn('auto_action_id');
            // $table->dropColumn('action_kick_of_player_id');
            // $table->dropColumn('action_contribution_id');
            // $table->dropColumn('home_gk_id');
            // $table->dropColumn('guest_gk_id');
            // $table->dropColumn('is_action_additional');
            // $table->dropColumn('type');
            // $table->dropColumn('order');
            $table->float('coord_x')->change();
            $table->float('coord_y')->change();
            $table->float('ball_goal_coord_x')->change();
            $table->float('ball_goal_coord_y')->change();
            $table->integer('timer_at')->nullable()->after('guest_gk_member_id');
            $table->integer('timer_additional_at')->nullable()->after('timer_at');
            $table->float('sub_coord_x')->nullable()->after('timer_additional_at');
            $table->float('sub_coord_y')->nullable()->after('sub_coord_x');
            $table->string('shoot_area_key')->nullable()->after('sub_coord_y');
            $table->string('pattern')->nullable()->after('shoot_area_key');
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
            $table->dropColumn('team1_ball_control');
            $table->dropColumn('team2_ball_control');
        });

        Schema::table('lineups', function (Blueprint $table) {
            $table->dropColumn('people_starting');
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->dropColumn('timer_at');
            $table->dropColumn('timer_additional_at');
            $table->dropColumn('sub_coord_x');
            $table->dropColumn('sub_coord_y');
            $table->dropColumn('shoot_area_key');
            $table->dropColumn('pattern');
        });
    }
}
