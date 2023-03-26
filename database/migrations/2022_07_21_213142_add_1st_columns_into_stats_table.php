<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Add1stColumnsIntoStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('stats');
        Schema::create('stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('match_id')->unsigned()->nullable();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->bigInteger('sub_member_id')->unsigned()->nullable();
            $table->integer('action_id')->unsigned()->nullable();
            $table->integer('action_created')->nullable();
            $table->integer('sub_action_id')->nullable();
            $table->integer('coord_x')->nullable();
            $table->integer('coord_y')->nullable();
            $table->boolean('result')->nullable();
            $table->date('created_at')->nullable();
            $table->string('created_at_round')->nullable();
            // attributes of error
            $table->integer('fouls_id')->nullable();
            $table->integer('fouls_judgment_type_id')->nullable();
            $table->integer('fouls_reason_received_card_id')->nullable();
            $table->integer('fouls_free_kick_id')->nullable();
            // attributes of kick
            $table->integer('ball_goal_coord_x')->nullable();
            $table->integer('ball_goal_coord_y')->nullable();
            $table->integer('ball_goal_number')->nullable();
            $table->integer('action_kick_of_player_id')->nullable();
            $table->integer('action_kick_situation_id')->nullable();
            $table->integer('action_kick_gk_id')->nullable();
            $table->integer('action_kick_block_id')->nullable();
            // attributes of contribution
            $table->integer('action_contribution_id')->nullable();
            $table->string('action_contribution_data')->nullable();
            $table->integer('action_contribution_score')->nullable();
            // attributes of pa area
            $table->boolean('is_pa_home_area')->nullable();
            $table->boolean('is_pa_guest_area')->nullable();
            // attributes of wings area
            $table->boolean('is_wings_home_area')->nullable();
            $table->boolean('is_wings_guest_area')->nullable();
            // attributes of pitch area
            $table->boolean('is_pitch_home_area')->nullable();
            $table->boolean('is_pitch_guest_area')->nullable();
            // attributes of GK
            $table->boolean('home_gk_id')->nullable();
            $table->boolean('guest_gk_id')->nullable();
            // attributes flag is edit.
            $table->boolean('is_edit')->nullable();

            $table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('sub_member_id')->references('id')->on('members')->onDelete('cascade');
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
