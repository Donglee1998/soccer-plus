<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdjustRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE registrations CHANGE COLUMN contract_premium1 contract_premium1 TINYINT NULL");
        \DB::statement("ALTER TABLE registrations CHANGE COLUMN contract_premium2 contract_premium2 TINYINT NULL");
        \DB::statement("ALTER TABLE registrations CHANGE COLUMN contract_premium3 contract_premium3 TINYINT NULL");
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
}
