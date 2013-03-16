<?php

namespace Bgy\Resource;

class ResourceBuilder {

    private $fields = array();

    private $objectToUse;

    static public function create()
    {
        return new self();
    }

    public function using($object)
    {
        if (!is_object($object)) {

            throw new \InvalidArgumentException('$object should be an object, obviously.');
        }

        $this->objectToUse = $object;

        return $this;
    }

    public function newField($fieldName)
    {
        return new ResourceFieldBuilder($fieldName, $this);
    }

    public function appendField(ResourceField $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    public function build()
    {
        $object = $this->objectToUse ?: new \stdClass();

        /** @var $field ResourceField */
        foreach ($this->fields as $field) {
            if ($field->hasIfCondition()) {
                if (!call_user_func($field->getIfCondition(), $field->getRawValue())) {

                    continue;
                }
            }

            if ($field->hasTransformerCallback()) {
                $field->setValue(call_user_func($field->getTransformCallback(), $field->getRawValue()));
            } else {
                $field->setValue($field->getRawValue());
            }

            if ($object instanceof \stdClass) {

                $object->{$field->getFieldName()} = $field->getValue();

            } else {
                $reflectionObject = new \ReflectionObject($object);
                if ($reflectionObject->hasProperty($field->getFieldName())
                    && $reflectionObject->getProperty($field->getFieldName())->isPublic()) {

                    $object->{$field->getFieldName()} = $field->getValue();

                } elseif ($reflectionObject->hasMethod($field->getFieldName())
                    && $reflectionObject->getMethod($field->getFieldName())->isPublic()) {

                    $method = $field->getFieldName();
                    $object->$method($field->getValue());

                } elseif ($reflectionObject->hasMethod('set'.ucfirst($field->getFieldName()))
                    && $reflectionObject->getMethod('set' . ucfirst($field->getFieldName()))->isPublic()) {

                    $method = 'set' . ucfirst($field->getFieldName());
                    $object->$method($field->getValue());

                } else {
                    throw new \RuntimeException('Unable to set ' . $field->getFieldName() . '. A property or a setter method must exist');
                }
            }
        }

        return $object;
    }
}
