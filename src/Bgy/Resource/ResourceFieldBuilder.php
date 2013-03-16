<?php

namespace Bgy\Resource;

class ResourceFieldBuilder
{
    /**
     * @var ResourceField
     */
    private $field;

    /**
     * @var ResourceBuilder
     */
    private $builder;

    /**
     * @param $fieldName
     * @param ResourceBuilder $builder
     * @throws \InvalidArgumentException
     */
    public function __construct($fieldName, ResourceBuilder $builder)
    {
        if (!is_string($fieldName)) {

            throw new \InvalidArgumentException('$fieldName must be a string');
        }

        if (is_numeric(substr($fieldName, 0, 1))) {

            throw new \InvalidArgumentException('$fieldName must not start with a number');
        }

        $this->field = new ResourceField($fieldName);
        $this->builder = $builder;
    }

    /**
     * @param $value
     * @return ResourceFieldBuilder
     */
    public function withValue($value)
    {
        $this->field->setRawValue($value);

        return $this;
    }

    /**
     * @param $callback
     * @return ResourceFieldBuilder
     * @throws \InvalidArgumentException
     */
    public function transformWith($callback)
    {
        if (!is_callable($callback)) {

            throw new \InvalidArgumentException('$callback must be a callable (Closure, callback function, Object implementing __invoke()');
        }

        $this->field->setTransformCallback($callback);

        return $this;
    }

    /**
     * @param $callback
     * @return ResourceFieldBuilder
     * @throws \InvalidArgumentException
     */
    public function populateIf($callback)
    {
        if (!is_callable($callback)) {

            throw new \InvalidArgumentException('$callback must be a callable (Closure, callback function, Object implementing __invoke()');
        }

        $this->field->setIfCondition($callback);

        return $this;
    }

    /**
     * @return ResourceBuilder
     */
    public function end()
    {
        $this->builder->appendField($this->field);
        return $this->builder;
    }
}
