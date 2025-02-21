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
    #[OA\Property(property: 'questions', type: 'array', items: new OA\Items(ref: '#/components/schemas/QuestionResource',))]
    #[OA\Property(property: 'Tags', type: 'array', items: new OA\Items(ref: '#/components/schemas/TagResource',))]
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
            'questions' => $topic->relationLoaded('questions') ? QuestionResource::collection($topic->getAttribute('questions')) : null,
            'tags' => $topic->relationLoaded('tags') ? TagResource::collection($topic->getAttribute('tags')) : null,
            'created_at' => $topic->getAttribute(Topic::CREATED_AT), //todo datetime formatter
            'updated_at' => $topic->getAttribute(Topic::UPDATED_AT),
        ];
    }
}
