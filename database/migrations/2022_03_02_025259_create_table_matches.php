<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMatches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->integer('team_id1');
            $table->tinyInteger('team_color1')->nullable();
            $table->integer('team_id2');
            $table->tinyInteger('team_color2')->nullable();
            $table->string('conference_name')->nullable();
            $table->tinyInteger('type')->nullable()->comment('練習 公式 研究');
            $table->tinyInteger('team_owner')->nullable()->comment('ホーム アウェイ');
            $table->date('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('place')->nullable();
            $table->string('referee')->nullable()->comment('主審');
            $table->string('linesman')->nullable()->comment('副審');
            $table->string('fourth_referee')->nullable()->comment('第4の審判員');
            $table->string('add_referee')->nullable()->comment('追加副審');
            $table->string('substitute_referee')->nullable()->comment('リザーブ副審:');
            $table->string('var_referee')->nullable()->comment('Video assistant referee');
            $table->tinyInteger('weather')->nullable()->comment('気候・ピッチ状態');
            $table->tinyInteger('pitch_type')->nullable()->comment('土・人工芝・天然芝');
            $table->tinyInteger('situation')->nullable()->comment('良・悪');
            $table->tinyInteger('number_people')->nullable()->comment('人数');
            $table->unsignedTinyInteger('round1_time')->nullable();
            $table->unsignedTinyInteger('round2_time')->nullable();
            $table->unsignedTinyInteger('round3_time')->nullable();
            $table->unsignedTinyInteger('round4_time')->nullable();
            $table->tinyInteger('additional_time1')->nullable();
            $table->tinyInteger('additional_time2')->nullable();
            $table->tinyInteger('additional_time3')->nullable();
            $table->tinyInteger('additional_time4')->nullable();
            $table->tinyInteger('rest_time')->nullable()->comment('前後半 休憩');
            $table->unsignedTinyInteger('extra_time')->nullable();
            $table->tinyInteger('penalty')->nullable()->comment('あり なし');
            $table->text('comment')->nullable();
            $table->tinyInteger('team1_score')->default(0);
            $table->tinyInteger('team2_score')->default(0);
            $table->tinyInteger('status')->default('0');
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_matches');
    }
}
