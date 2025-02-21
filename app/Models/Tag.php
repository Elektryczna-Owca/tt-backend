<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read Collection<Tag> $questions
 */
class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    public const string ID = 'id';
    public const string NAME = 'name';
    public const string CREATED_AT =  'created_at';
    public const string UPDATED_AT =  'updated_at';

}
