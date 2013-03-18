<?php

namespace Bgy\MediaType;

class MediaTypeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider mediaTypesProvider
     *
     * @param MediaType $mediaType
     * @param $expectedString
     */
    public function testMediaTypeToString(MediaType $mediaType, $expectedString)
    {
        $this->assertEquals($expectedString, $mediaType->__toString());
    }

    public function mediaTypesProvider()
    {
        return array(
            array(
                new MediaType('application', 'vnd.acme', 'json', '1.0', array('q' => '0.5')),
                'application/vnd.acme+json; version=1.0; q=0.5'
            ),
            array(
                new MediaType('application', 'vnd.acme', 'xml', '1.0'),
                'application/vnd.acme+xml; version=1.0'
            ),
            array(
                new MediaType('application', 'vnd.acme', 'xml'),
                'application/vnd.acme+xml'
            ),
            array(
                new MediaType('application', 'json'),
                'application/json'
            )
        );
    }
}
