<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHomeGkIdAndGuestGkIdTypeStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stats', function (Blueprint $table) {
            $table->bigInteger('home_gk_id')->unsigned()->nullable()->change();
            $table->bigInteger('guest_gk_id')->unsigned()->nullable()->change();

            $table->foreign('home_gk_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('guest_gk_id')->references('id')->on('members')->onDelete('cascade');
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
            $table->boolean('home_gk_id')->nullable();
            $table->boolean('guest_gk_id')->nullable();
        });
    }
}
