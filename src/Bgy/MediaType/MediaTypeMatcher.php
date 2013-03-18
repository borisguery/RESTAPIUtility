<?php

namespace Bgy\MediaType;

use Bgy\MediaType\MediaType;
use Zend\Http\Header\Accept;

class MediaTypeMatcher implements MediaTypeMatcherInterface {

    public function getMatchedMediaType(array $requestedMediaTypes, array $allowedMediaTypes = array())
    {
        $accept = new Accept();
        /** @var $allowedMediaType MediaType */
        foreach ($allowedMediaTypes as $allowedMediaType) {
            if (!$allowedMediaType instanceof MediaType) {

                throw new \InvalidArgumentException('$allowedMediaTypes should contain only MediaType instances');
            }
        }

        return $requestedMediaTypes;
    }
}
