<?php

namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Resources\InfoResource;
use App\Http\Resources\Topic\TopicResource;
use App\Services\Topic\StoreTopicDTO;
use App\Services\Topic\TopicsService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/topics',
    security: [['passport' => ['*']]],
    tags: ['Topic'],
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
class GetTopicsController extends Controller //todo Tests
{
    public function __construct(private readonly TopicsService $topicsService)
    {
    }

    public function __invoke(): AnonymousResourceCollection
    {
        $topics = $this->topicsService->getAll(); //todo Pagination and filters

        return TopicResource::collection($topics);
    }
}
