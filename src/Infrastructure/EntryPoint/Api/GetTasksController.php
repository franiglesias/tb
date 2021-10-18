<?php
declare (strict_types=1);

namespace App\Infrastructure\EntryPoint\Api;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetTasksController
{
    public function __invoke(): Response
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }
}
