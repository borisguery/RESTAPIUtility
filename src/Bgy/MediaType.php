<?php

namespace Bgy;

class MediaType
{
    private $type;
    private $subtype;
    private $format;
    private $version;

    public function __construct($type, $subtype, $format, $version)
    {
        $this->type    = $type;
        $this->subtype = $type;
        $this->format  = $format;
        $this->version = $version;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function getSubtype()
    {
        return $this->subtype;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function __toString()
    {
        return sprintf(
            '%s/%s+%s; v=%s',
            $this->getType(), $this->getSubtype(), $this->getFormat(), $this->getVersion()
        );
    }
}
