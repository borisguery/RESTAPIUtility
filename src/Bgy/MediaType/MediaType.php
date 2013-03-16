<?php

namespace Bgy\MediaType;

class MediaType
{
    private $type;
    private $subtype;
    private $format;
    private $version;
    private $parameters;

    public function __construct($type, $subtype, $format = null, $version = null, array $parameters = array())
    {
        $this->type    = $type;
        $this->subtype = $subtype;
        $this->format  = $format;
        $this->version = $version;
        $this->parameters = $parameters;
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
        $str = sprintf('%s/%s', $this->getType(), $this->getSubtype());

        if (!empty($this->format)) {
            $str .= sprintf('+%s', $this->format);
        }

        if  (!empty($this->version)) {
            $str .= sprintf('; version=%s', $this->version);
        }

        if  (!empty($this->parameters)) {
            foreach ($this->parameters as $name => $value) {
                $str .= sprintf('; %s=%s', $name, $value);
            }
        }

        return $str;
    }
}
