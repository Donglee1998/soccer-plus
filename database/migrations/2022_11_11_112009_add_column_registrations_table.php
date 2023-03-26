<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('email')->nullable()->after('type');
            $table->string('username')->nullable()->after('email');
            $table->string('password')->nullable()->after('username');
            $table->string('password_confirm')->nullable()->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('username');
            $table->dropColumn('password');
            $table->dropColumn('password_confirm');
        });
    }
}
