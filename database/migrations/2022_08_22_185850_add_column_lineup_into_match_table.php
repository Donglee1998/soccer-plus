<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnLineupIntoMatchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lineups', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->integer('created_by')->after('title')->nullable();
        });

        Schema::table('matches', function (Blueprint $table) {
            $table->integer('lineup_id1')->after('team_id1')->nullable();
            $table->integer('lineup_id2')->after('team_id2')->nullable();
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
            $table->dropColumn('lineup_id1');
            $table->dropColumn('lineup_id2');
        });
    }
}
