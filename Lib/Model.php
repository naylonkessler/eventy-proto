<?php

namespace Lib;

/**
 * Model base class.
 */
class Model
{
    /**
     * Mapped table name.
     *
     * @var string
     */
    public $table;

    /**
     * Model attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Get an attribute.
     *
     * @param  string  $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->attributes[$name];
    }

    /**
     * Set an attribute.
     *
     * @param  string  $name
     * @param  mixed  $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    /**
     * Return model data as array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->attributes;
    }
}
