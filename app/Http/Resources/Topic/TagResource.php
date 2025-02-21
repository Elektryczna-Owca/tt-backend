<?php

namespace App\Http\Resources\Topic;

use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'TagResource',
    description: 'TagResource'
)]
class TagResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'name', type: 'string')]
    #[OA\Property(property: 'description', type: 'string')]
    #[OA\Property(property: 'created_at', type: 'string')]
    #[OA\Property(property: 'updated_at', type: 'string')]
    public function toArray($request): array
    {
        /** @var Tag $tag */
        $tag = $this->resource;

        return [
            'id' => $tag->getAttribute(Tag::ID),
            'name' => $tag->getAttribute(Tag::NAME),
            'created_at' => $tag->getAttribute(Topic::CREATED_AT), //todo datetime formatter
            'updated_at' => $tag->getAttribute(Topic::UPDATED_AT),
        ];
    }
}
