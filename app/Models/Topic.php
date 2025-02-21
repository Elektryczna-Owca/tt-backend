<?php

namespace App\Models;

use Database\Factories\TopicFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read  Collection<Tag> $tags
 * @property-read  Collection<Tag> $questions
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


    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
