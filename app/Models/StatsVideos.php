<?php

namespace App\Models;

use App\Traits\TraitModel;
use App\Traits\UnixTimestampSerializable;
use Illuminate\Database\Eloquent\Model;

class StatsVideos extends Model
{
    use UnixTimestampSerializable;
    use TraitModel;

    protected $table = 'stats_videos';

    protected $fillable = [
        'match_id',
        'stat_id',
        'video_id',
        'round',
        'time_start_play',
        'time_stop_play',
        'replace_next_flg',
        'comment',
    ];

    public function stat()
    {
        return $this->belongsTo(Stat::class, 'stat_id', 'id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
