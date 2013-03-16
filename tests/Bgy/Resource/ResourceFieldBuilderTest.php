<?php

namespace Bgy\Resource;

class ResourceFieldBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $resourceBuilderMock = $this->getMockBuilder('\Bgy\Resource\ResourceBuilder')
            ->getMock()
        ;

        $f = new ResourceFieldBuilder('foobar', $resourceBuilderMock);

        $this->assertInstanceOf('\Bgy\Resource\ResourceFieldBuilder', $f);
    }

    public function testConstructorThrowInvalidArgumentExceptionIfFieldNameIsNotAString()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $resourceBuilderMock = $this->getMockBuilder('\Bgy\Resource\ResourceBuilder')
            ->getMock()
        ;

        new ResourceFieldBuilder(new \stdClass(), $resourceBuilderMock);
    }

    public function testConstructorThrowInvalidArgumentExceptionIfFieldNameStartsWithANumber()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $resourceBuilderMock = $this->getMockBuilder('\Bgy\Resource\ResourceBuilder')
            ->getMock()
        ;

        new ResourceFieldBuilder('1foobar', $resourceBuilderMock);
    }
}
