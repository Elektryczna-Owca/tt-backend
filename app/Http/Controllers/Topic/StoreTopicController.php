<?php

namespace App\Http\Controllers\Topic;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Resources\InfoResource;
use App\Http\Resources\Topic\TopicResource;
use App\Services\Topic\StoreTopicDTO;
use App\Services\Topic\TopicsService;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: '/topics',
    security: [['passport' => ['*']]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(ref: '#/components/schemas/StoreTopicRequest'),
    ),
    tags: ['Invoice'],
    responses: [
        new OA\Response(
            response: Response::HTTP_CREATED,
            description: 'OK',
            content: new OA\JsonContent(
                ref: '#/components/schemas/TopicResource',
            ),
        ),
        new OA\Response(
            response: Response::HTTP_UNAUTHORIZED,
            description: 'Unauthorized',
        ),
        new OA\Response(
            response: Response::HTTP_UNPROCESSABLE_ENTITY,
            description: 'Validation Failed',
        ),
    ]
)]
class StoreTopicController extends Controller
{
    public function __construct(private TopicsService $topicsService)
    {
    }

    public function __invoke(StoreTopicRequest $request)
    {
        $topic = $this->topicsService->storeTopic(new StoreTopicDTO(...$request->validated()));

        return (new InfoResource(TopicResource::make($topic)))
            ->setMessage(__('messages.update.success', ['model' => __('models.topic')]))
            ->setStatusCode(Response::HTTP_OK);
    }
}
