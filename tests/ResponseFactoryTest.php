<?php

namespace Bgy;


class ResponseFactoryTest extends \PHPUnit_Framework_TestCase {

    public function testCreateResponseWithMediaType()
    {
        $f = new ResponseFactory();
        $actualResponse = $f->createResponse();
    }
}
