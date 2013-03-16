<?php

namespace Bgy;

use Symfony\Component\HttpFoundation\Response;

class ResponseFactory
{
    public function createResponse(MediaType $mediaType)
    {
        $response = new Response();
        $response->headers->set('Content-Type', (string) $mediaType);

        return $response;
    }
}
