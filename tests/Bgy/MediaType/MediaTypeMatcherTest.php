<?php


namespace Bgy\MediaType;


class MediaTypeMatcherTest extends \PHPUnit_Framework_TestCase
{
    public function testGetMatchedMediaType()
    {
        $matcher = new MediaTypeMatcher();

        $m1 = new MediaType('application', 'vnd.acme.user', 'json', 1.0);
        $m2 = new MediaType('application', 'json', null, null);

        $requestedMediaType = new MediaType('application', 'vnd.acme.user', 'json', 1.0);

        $matched = $matcher->getMatchedMediaType(array($requestedMediaType), array($m1, $m2));

//        var_dump($matched);
    }
}
