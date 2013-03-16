<?php

namespace Bgy\Resource;

/**
 * Class ResourceField
 * @package Bgy
 */
class ResourceField
{
    /**
     * @var string
     */
    private $fieldName;

    /**
     * @var
     */
    private $rawValue;

    private $value;

    /**
     * @var
     */
    private $transformCallback;

    /**
     * @var
     */
    private $ifCondition;

    /**
     * @var
     */
    private $defaultValue;

    /**
     * @param $fieldName
     */
    public function __construct($fieldName)
    {
        $this->fieldName = $fieldName;
    }

    /**
     * @param  $ifCondition
     * @return ResourceField
     */
    public function setIfCondition($ifCondition)
    {
        $this->ifCondition = $ifCondition;

        return $this;
    }

    /**
     * @return
     */
    public function getIfCondition()
    {
        return $this->ifCondition;
    }

    public function hasIfCondition()
    {
        return isset($this->ifCondition);
    }

    /**
     * @param  $rawValue
     * @return ResourceField
     */
    public function setRawValue($rawValue)
    {
        $this->rawValue = $rawValue;

        return $this;
    }

    /**
     * @return
     */
    public function getRawValue()
    {
        return $this->rawValue;
    }

    /**
     * @param $transformCallback
     * @return ResourceField
     */
    public function setTransformCallback($transformCallback)
    {
        $this->transformCallback = $transformCallback;

        return $this;
    }

    /**
     * @return
     */
    public function getTransformCallback()
    {
        return $this->transformCallback;
    }

    public function hasTransformerCallback()
    {
        return isset($this->transformCallback);
    }

    /**
     * @param $defaultValue
     * @return ResourceField
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    public function hasDefaultValue()
    {
        return isset($this->defaultValue);
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }
}
