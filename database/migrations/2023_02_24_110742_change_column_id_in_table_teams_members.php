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

        // Drop column in stats
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `pos_kick_home_area_key`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `pos_kick_guest_area_key`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `action_kick_of_player_id`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `is_action_additional`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `action_contribution_id`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `auto_action_id`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `is_pa_home_area_key`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `is_pa_guest_area_key`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `is_wings_home_area_key`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `is_wings_guest_area_key`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `is_pitch_home_area_key`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `is_pitch_guest_area_key`");

        \DB::statement("ALTER TABLE `teams` DROP COLUMN `uuid`");
        \DB::statement("ALTER TABLE `teams` DROP COLUMN `team_id`");
        \DB::statement("ALTER TABLE `members` DROP COLUMN `uuid`");
        \DB::statement("ALTER TABLE `members` DROP COLUMN `member_id`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `uuid`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `stat_id`");

        \DB::statement("ALTER TABLE `matches` DROP FOREIGN KEY `matches_team_id1_foreign`");
        \DB::statement("ALTER TABLE `matches` DROP FOREIGN KEY `matches_team_id2_foreign`");
        \DB::statement("ALTER TABLE matches CHANGE COLUMN team_id1 team_id1 varchar(20) NOT NULL");
        \DB::statement("ALTER TABLE matches CHANGE COLUMN team_id2 team_id2 varchar(20) NOT NULL");

        \DB::statement("ALTER TABLE `lineups` DROP FOREIGN KEY `lineups_team_id_foreign`");
        \DB::statement("ALTER TABLE lineups CHANGE COLUMN team_id team_id varchar(20) NULL");

        \DB::statement("ALTER TABLE `members` DROP FOREIGN KEY `members_team_id_foreign`");
        \DB::statement("ALTER TABLE members CHANGE COLUMN team_id team_id varchar(20) NOT NULL");
        
        \DB::statement("ALTER TABLE `member_sheets` DROP FOREIGN KEY `member_sheets_member_id_foreign`");
        \DB::statement("ALTER TABLE member_sheets CHANGE COLUMN member_id member_id varchar(20) NOT NULL");

        \DB::statement("ALTER TABLE `stats` DROP FOREIGN KEY `stats_guest_gk_id_foreign`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `guest_gk_id`");
        \DB::statement("ALTER TABLE stats CHANGE COLUMN guest_gk_member_id guest_gk_member_id varchar(20) NULL");
        \DB::statement("ALTER TABLE `stats` DROP FOREIGN KEY `stats_home_gk_id_foreign`");
        \DB::statement("ALTER TABLE `stats` DROP COLUMN `home_gk_id`");
        \DB::statement("ALTER TABLE stats CHANGE COLUMN home_gk_member_id home_gk_member_id varchar(20) NULL");

        \DB::statement("ALTER TABLE `stats` DROP FOREIGN KEY `stats_sub_member_id_foreign`");
        \DB::statement("ALTER TABLE stats CHANGE COLUMN sub_member_id sub_member_id varchar(20) NULL");
        \DB::statement("ALTER TABLE `stats` DROP FOREIGN KEY `stats_member_id_foreign`");
        \DB::statement("ALTER TABLE stats CHANGE COLUMN member_id member_id varchar(20) NULL");
        
        \DB::statement("ALTER TABLE teams CHANGE COLUMN id id varchar(20) NOT NULL");
        \DB::statement("ALTER TABLE members CHANGE COLUMN id id varchar(20) NOT NULL");

        \DB::statement("ALTER TABLE `matches` ADD FOREIGN KEY (`team_id1`) REFERENCES `teams` (`id`) ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `matches` ADD FOREIGN KEY (`team_id2`) REFERENCES `teams` (`id`) ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `lineups` ADD FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `members` ADD FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`) ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `member_sheets`ADD FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE");
        // \DB::statement("ALTER TABLE `stats` ADD FOREIGN KEY (`guest_gk_member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE");
        // \DB::statement("ALTER TABLE `stats` ADD FOREIGN KEY (`home_gk_member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `stats` ADD FOREIGN KEY (`sub_member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE");
        \DB::statement("ALTER TABLE `stats` ADD FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE");
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
