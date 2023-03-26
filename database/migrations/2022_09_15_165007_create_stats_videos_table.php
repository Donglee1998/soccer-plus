<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatsVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats_videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('match_id');
            $table->unsignedBigInteger('stat_id');
            $table->unsignedBigInteger('video_id'); // Video liên kết
            $table->string('round');
            $table->string('time_start_play')->comment('再生時 Format 00:00:00'); // Thời gian bắt đầu play
            $table->string('time_stop_play')->comment('プレイ終了時 Format 00:00:00'); // Thời gian kết thúc play
            $table->tinyInteger('replace_next_flg')->comment('0 or 1 このプレイを基準に他のプレイの再生時も設定する'); // Check vào thì sẽ lấy stat tương ứng làm chuẩn để tính thời gian bắt đầu/kết thúc play cho các stat sau đó
            $table->text('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stats_videos');
    }
}
