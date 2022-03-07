<?php

namespace App\Enum\Base;

abstract class AbstractEnum
{
    /**
     * Cached constants
     *
     * @var array
     */
    protected static $constants = array();
    /**
     * Labels for choose
     *
     * @var array
     */
    protected static $labels = array();

    /**
     * Get array of constants for concrete enum class
     *
     * @return array
     */
    public static function getConstants()
    {
        $calledClass = get_called_class();

        if (!array_key_exists($calledClass, self::$constants)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$constants[$calledClass] = $reflect->getConstants();
        }

        return self::$constants[$calledClass];
    }

    /**
     * Get array of labels for concrete enum class
     * @return array
     */
    public static function getLabels()
    {
        return static::$labels;
    }

    /**
     * Get label value by constant value if exist
     *
     * @param $value
     * @return string
     */
    public static function getLabelByValue($value)
    {
        return isset(static::$labels[$value])?static::$labels[$value]:null;
    }
    /**
     * Check if constant name exists
     *
     * @param string $name
     * @param boolean $strict
     * @return boolean
     */
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();
        if ($strict) {
            return array_key_exists($name, $constants);
        }
        $keys = array_map('strtolower', array_keys($constants));

        return in_array(strtolower($name), $keys);
    }

    /**
     * Check if constant value exists
     *
     * @param $value
     * @param bool $strict
     * @return bool
     */
    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getConstants());

        return in_array($value, $values, $strict);
    }

}