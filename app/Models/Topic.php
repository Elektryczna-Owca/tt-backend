<?php

namespace App\Models;

use Database\Factories\TopicFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read  $tags
 * @property-read  Collection<Question> $questions
 */
class Topic extends Model
{
    /** @use HasFactory<TopicFactory> */
    use HasFactory;

    public const string ID = 'id';
    public const string NAME = 'name';
    public const string DESCRIPTION = 'description';
    public const string CREATED_AT =  'created_at';
    public const string UPDATED_AT =  'updated_at';

    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime'
    ];


    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }
}
