<?php

namespace App\Http\Resources\Topic;

use App\Models\Topic;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'TopicResource',
    description: 'TopicResource'
)]
class TopicResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'name', type: 'string')]
    #[OA\Property(property: 'description', type: 'string')]
    #[OA\Property(property: 'created_at', type: 'string')]
    #[OA\Property(property: 'updated_at', type: 'string')]
    public function toArray($request): array
    {
        /** @var Topic $topic */
        $topic = $this->resource;

        return [
            'id' => $topic->getAttribute(Topic::ID),
            'name' => $topic->getAttribute(Topic::NAME),
            'description' => $topic->getAttribute(Topic::DESCRIPTION),
            'created_at' => $topic->getAttribute(Topic::CREATED_AT), //todo datetime formatter
            'updated_at' => $topic->getAttribute(Topic::UPDATED_AT),
        ];
    }
}
