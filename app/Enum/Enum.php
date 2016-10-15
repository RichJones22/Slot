<?php
/**
 * Created by PhpStorm.
 * User: richjones
 * Date: 10/14/16
 * Time: 7:04 PM
 */

namespace app\Enum;


class Enum
{
    private static $constantsCache = [];

    public function makeArrayOf()
    {
        if ($count = count($this->getConstants()))
        {
            $str = "[";

            $nextToLast = $count--;

            $i = 1;
            foreach ($this->getConstants() as $key => $value)
            {
                if ($i == $nextToLast) {
                    $str .= "'$key'";
                } else {
                    $str .= "'$key',";
                }
                $i++;
            }
            $str .= "]";
            return $str;
        }

        return $this;

    }

    public function getConstants()
    {
        $calledClass = get_called_class();

        if(!array_key_exists($calledClass, self::$constantsCache))
        {
            $reflection = new \ReflectionClass($calledClass);
            self::$constantsCache[$calledClass] = $reflection->getConstants();
        }

        return self::$constantsCache[$calledClass];
    }
}