<?php

namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Resources\InfoResource;
use App\Http\Resources\Topic\TopicResource;
use App\Models\Topic;
use App\Services\Topic\TopicsService;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/topics/{topicId}',
    security: [['passport' => ['*']]],
    tags: ['Topic'],
    parameters: [
        new OA\Parameter(
            name: 'topicId',
            description: 'ID of topic',
            in: 'path',
            required: true,
            schema: new OA\Schema(
                type: 'integer',
            ),
            example: 1,
        ),
    ],
    responses: [
        new OA\Response(
            response: Response::HTTP_OK,
            description: 'OK',
            content: new OA\JsonContent(
                ref: '#/components/schemas/TopicResource',
            ),
        ),
        new OA\Response(
            response: Response::HTTP_UNAUTHORIZED,
            description: 'Unauthorized',
        ),
    ]
)]
class ShowTopicController extends Controller //todo Tests
{
    public function __construct(private readonly TopicsService $topicsService)
    {
    }

    public function __invoke(Topic $topic): TopicResource
    {
        $topics = $this->topicsService->loadRelations($topic);

        return TopicResource::make($topics);
    }
}
