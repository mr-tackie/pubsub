<?php

namespace App\Models;

use ReflectionClass;
use ReflectionProperty;

abstract class DataTransferObject{

    public function __construct(array $params = [])
    {
        $class = new ReflectionClass(static::class);

        foreach ($class->getProperties(ReflectionProperty::IS_PUBLIC) as $reflectionProperty){
            $property = $reflectionProperty->getName();
            $this->{$property} = $params[$property];
        }
    }

    abstract function toArray() : array;
}
