<?php

namespace Vuer\Notes\ValueObjects;

abstract class ValueObject
{
    protected $originalValue;

    public function __construct($value)
    {
        $this->originalValue = $value;
    }

    /**
     * Returns original value.
     * @return string
     */
    protected function getOriginal()
    {
        return $this->originalValue;
    }

    /**
     * Printing object.
     * @return string
     */
    public function __toString()
    {
        return $this->getOriginal();
    }

    /**
     * Mapping object variables to existed class functions.
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        $key = camel_case($key);
        return method_exists($this, $key) ? $this->$key() : null;
    }
}