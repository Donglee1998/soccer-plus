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
        \DB::statement("ALTER TABLE `lineups` DROP COLUMN `uuid`");
        \DB::statement("ALTER TABLE `lineups` DROP COLUMN `lineup_id`");
        \DB::statement("ALTER TABLE `lineups` DROP COLUMN `tmp_match_id`");
        \DB::statement("ALTER TABLE `matches` DROP COLUMN `add_referee`");
        \DB::statement("ALTER TABLE `matches` DROP COLUMN `substitute_referee`");
        \DB::statement("ALTER TABLE `matches` DROP COLUMN `var_referee`");

        \DB::statement("ALTER TABLE `matches` DROP FOREIGN KEY `matches_lineup_id1_foreign`");
        \DB::statement("ALTER TABLE `matches` DROP FOREIGN KEY `matches_lineup_id2_foreign`");
        \DB::statement("ALTER TABLE matches CHANGE COLUMN lineup_id1 lineup_id1 varchar(20) NULL");
        \DB::statement("ALTER TABLE matches CHANGE COLUMN lineup_id2 lineup_id2 varchar(20) NULL");

        \DB::statement("ALTER TABLE lineups CHANGE COLUMN id id varchar(20) NOT NULL");

        \DB::statement("ALTER TABLE `matches` ADD FOREIGN KEY (`lineup_id1`) REFERENCES `lineups` (`id`) ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `matches` ADD FOREIGN KEY (`lineup_id2`) REFERENCES `lineups` (`id`) ON DELETE CASCADE");
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
