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
        Schema::table('stats', function (Blueprint $table) {
            $table->float('ball_goal_number_coord_x')->nullable()->after('ball_goal_type');
            $table->float('ball_goal_number_coord_y')->nullable()->after('ball_goal_number_coord_x');
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
            $table->dropColumn('ball_goal_number_coord_x');
            $table->dropColumn('ball_goal_number_coord_y');
        });
    }
};
