<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTmpLineup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lineups', function (Blueprint $table) {
            $table->boolean('tmp_lineup')->nullable()->after('id');
        });
        Schema::table('matches', function (Blueprint $table) {
            $table->string('tmp_lineup_id1', 20)->nullable()->after('lineup_id1');
            $table->string('tmp_lineup_id2', 20)->nullable()->after('lineup_id2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
