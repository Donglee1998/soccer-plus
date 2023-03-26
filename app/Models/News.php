<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class News extends Model
{
    use SoftDeletes;

    /**
     * The database table used by the model.
     * @var string
     */
    protected $table = 'news';

    /**
     * The attribute that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'public_date',
        'category',
        'sub_category',
        'title',
        'editor',
        'is_public',
        'start_date',
        'end_date',
        'update_comment',
        'is_draft',
        'order',
        'overview',
    ];

    /**
     * Scope a query to only include records from non-draft article.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeNotDraft($query)
    {
        return $query->where('is_draft', 0)->orWhereNull('is_draft');
    }

    public function getStartDateAttribute( $field ) {
        return $field ? (new Carbon($field))->format('Y-m-d H:i') : '';
    }

    public function getEndDateAttribute( $field ) {
        return $field ? (new Carbon($field))->format('Y-m-d H:i') : '';
    }
}
