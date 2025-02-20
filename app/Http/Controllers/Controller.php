<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "0.0.1",
    description: "TableTopics API documentation",
    title: "TableTopics API",
)]
#[OA\Server(
    url: L5_SWAGGER_CONST_HOST, //@phpstan-ignore-line
    description: "Server"
)]
#[OA\ExternalDocumentation(
    description: "Find out more about Swagger",
    url: "http://swagger.io"
)]
abstract class Controller extends BaseController
{
    use ValidatesRequests;
}
