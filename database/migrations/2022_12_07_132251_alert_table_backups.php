<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlertTableBackups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lineups', function (Blueprint $table) {
            $table->unsignedBigInteger('lineup_id')->nullable()->after('id');
            $table->string('uuid')->nullable()->after('lineup_id');
            $table->json('pattern')->nullable()->after('not_member');
            $table->string('pattern_name')->nullable()->after('pattern');
            $table->softDeletes();
            $table->unsignedBigInteger('team_id')->change();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('match_id')->nullable()->after('id');
            $table->string('uuid')->nullable()->after('match_id');
            $table->unsignedBigInteger('team_id1')->change();
            $table->unsignedBigInteger('team_id2')->change();
            $table->unsignedBigInteger('lineup_id1')->change();
            $table->unsignedBigInteger('lineup_id2')->change();
            $table->foreign('team_id1')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team_id2')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('lineup_id1')->references('id')->on('lineups')->onDelete('cascade');
            $table->foreign('lineup_id2')->references('id')->on('lineups')->onDelete('cascade');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->bigInteger('member_id')->nullable()->after('id');
            $table->string('uuid')->nullable()->after('member_id');
            $table->tinyInteger('sub_position')->nullable()->after('position');
            $table->unsignedBigInteger('team_id')->change();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });

        Schema::table('tactics', function (Blueprint $table) {
            $table->unsignedBigInteger('tactic_id')->nullable()->after('id');
            $table->string('uuid')->nullable()->after('tactic_id');
            $table->datetime('synced_at')->nullable()->after('updated_at');
        });

        Schema::table('sheets', function (Blueprint $table) {
            $table->unsignedBigInteger('sheet_id')->nullable()->after('id');
            $table->string('uuid')->nullable()->after('sheet_id');
        });

        Schema::table('teams', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable()->after('id');
            $table->string('uuid')->nullable()->after('team_id');
            $table->renameColumn('order', 'order_number');
            $table->string('team_code')->nullable()->after('is_home');
        });

        Schema::table('stats', function (Blueprint $table) {
            $table->unsignedBigInteger('stat_id')->nullable()->after('id');
            $table->string('uuid')->nullable()->after('stat_id');
            $table->integer('home_gk_member_id')->nullable()->after('sub_member_id');
            $table->integer('guest_gk_member_id')->nullable()->after('home_gk_member_id');
            $table->integer('action_kick_member_id')->nullable()->after('guest_gk_member_id');
            $table->boolean('is_pa_home_area_key')->nullable()->after('action_kick_member_id');
            $table->boolean('is_pa_guest_area_key')->nullable()->after('is_pa_home_area_key');
            $table->boolean('is_wings_home_area_key')->nullable()->after('is_pa_guest_area_key');
            $table->boolean('is_wings_guest_area_key')->nullable()->after('is_wings_home_area_key');
            $table->boolean('is_pitch_home_area_key')->nullable()->after('is_wings_guest_area_key');
            $table->boolean('is_pitch_guest_area_key')->nullable()->after('is_pitch_home_area_key');
            $table->string('pos_kick_home_area_key')->nullable()->after('is_pitch_guest_area_key');
            $table->string('pos_kick_guest_area_key')->nullable()->after('pos_kick_home_area_key');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lineups', function (Blueprint $table) {
            $table->dropColumn('pattern');
            $table->dropColumn('deleted_at');
        });

        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('sub_position');
        });

        Schema::table('tactics', function (Blueprint $table) {
            $table->dropColumn('synced_at');
        });

        chema::table('stats', function (Blueprint $table) {
            $table->dropColumn('home_gk_member_id');
            $table->dropColumn('guest_gk_member_id');
            $table->dropColumn('action_kick_member_id');
            $table->dropColumn('is_pa_home_area_key');
            $table->dropColumn('is_pa_guest_area_key');
            $table->dropColumn('is_wings_home_area_key');
            $table->dropColumn('is_wings_guest_area_key');
            $table->dropColumn('is_pitch_home_area_key');
            $table->dropColumn('is_pitch_guest_area_key');
            $table->dropColumn('pos_kick_home_area_key');
            $table->dropColumn('pos_kick_guest_area_key');
        });

    }
}
