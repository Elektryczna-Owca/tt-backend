<?php

namespace App\Models;

use Database\Factories\TopicFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read  $tags
 * @property-read  $questions
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
}
