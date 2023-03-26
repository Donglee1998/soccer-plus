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
        \DB::statement("ALTER TABLE matches CHANGE COLUMN additional_time1 additional_time1 int NULL");
        \DB::statement("ALTER TABLE matches CHANGE COLUMN additional_time2 additional_time2 int NULL");
        \DB::statement("ALTER TABLE matches CHANGE COLUMN additional_time3 additional_time3 int NULL");
        \DB::statement("ALTER TABLE matches CHANGE COLUMN additional_time4 additional_time4 int NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
};
