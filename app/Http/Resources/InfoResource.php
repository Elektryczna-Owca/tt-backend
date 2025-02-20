<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    title: 'InfoResource',
    description: 'InfoResource'
)]
class InfoResource extends JsonResource
{
    protected int $statusCode = 200;

    protected string $message = 'OK';

    protected ?array $meta = null;

    /**
     * InfoResource constructor.
     * @param null $resource
     */
    public function __construct($resource = null)
    {
        parent::__construct($resource);
    }

    #[OA\Property(
        property: 'message',
        type: 'string',
    )]
    #[OA\Property(
        property: 'data',
        type: 'resource',
        nullable: true,
    )]
    public function toArray($request): array
    {
        return [
            'message' => $this->message,
            'data' => $this->resource,
        ];
    }

    /**
     * @param int $statusCode
     * @return InfoResource
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @param string $message
     * @return InfoResource
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @param array $meta
     * @return InfoResource
     */
    public function setMeta(array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Customize the outgoing response status code for the resource.
     *
     * @param $request
     * @param $response
     * @return void
     */
    public function withResponse($request, $response)
    {
        $response->setStatusCode($this->statusCode);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function with($request): array
    {
        if (! $this->meta) {
            return [];
        }

        return [
            'meta' => $this->meta,
        ];
    }
}
