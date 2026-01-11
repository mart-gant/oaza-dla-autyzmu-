<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "Oaza dla Autyzmu API",
    description: "RESTful API dla platformy Oaza dla Autyzmu - społeczność wspierająca osoby z autyzmem i ich rodziny",
    contact: new OA\Contact(
        name: "Oaza dla Autyzmu",
        email: "kontakt@oazadlaautyzmu.pl"
    )
)]
#[OA\Server(
    url: "/api/v1",
    description: "API v1"
)]
#[OA\SecurityScheme(
    securityScheme: "bearerAuth",
    type: "http",
    scheme: "bearer",
    bearerFormat: "JWT"
)]
#[OA\Tag(
    name: "Authentication",
    description: "Endpoints for user authentication"
)]
#[OA\Tag(
    name: "Facilities",
    description: "Endpoints for managing facilities (schools, therapy centers, etc.)"
)]
#[OA\Tag(
    name: "Forum",
    description: "Endpoints for forum topics and posts"
)]
class OpenApiController extends Controller
{
    // This controller is only used for OpenAPI documentation
}
