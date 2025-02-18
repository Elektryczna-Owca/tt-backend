<?php

namespace App\Models;

use Database\Factories\QuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read  Topic $topic
 */
class Question extends Model
{
    /** @use HasFactory<QuestionFactory> */
    use HasFactory;

    public const string ID = 'id';
    public const string TEXT = 'text';
    public const string TOPIC_ID = 'topic_id';
    public const string CREATED_AT =  'created_at';
    public const string UPDATED_AT =  'updated_at';

    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime'
    ];


    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

}
