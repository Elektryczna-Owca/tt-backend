<?php

namespace App\Http\Resources\Topic;

use App\Models\Question;
use App\Models\Tag;
use App\Models\Topic;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'QuestionResource',
    description: 'QuestionResource'
)]
class QuestionResource extends JsonResource
{
    #[OA\Property(property: 'id', type: 'integer')]
    #[OA\Property(property: 'text', type: 'string')]
    #[OA\Property(property: 'created_at', type: 'string')]
    #[OA\Property(property: 'updated_at', type: 'string')]
    public function toArray($request): array
    {
        /** @var Question $question */
        $question = $this->resource;

        return [
            'id' => $question->getAttribute(Question::ID),
            'text' => $question->getAttribute(Question::TEXT),
            'created_at' => $question->getAttribute(Topic::CREATED_AT), //todo datetime formatter
            'updated_at' => $question->getAttribute(Topic::UPDATED_AT),
        ];
    }
}
