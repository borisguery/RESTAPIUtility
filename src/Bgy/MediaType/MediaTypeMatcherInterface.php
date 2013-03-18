<?php

namespace Bgy\MediaType;

use Bgy\MediaType\MediaType;

interface MediaTypeMatcherInterface
{
    public function getMatchedMediaType(array $requestedMediaTypes, array $allowedMediaTypes);
}
