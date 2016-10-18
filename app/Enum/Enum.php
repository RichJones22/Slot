<?php namespace app\Enum;


class Enum
{
    private static $constantsCache = [];

    private $calledClass = null;

    public function __construct()
    {
        $this->calledClass = get_called_class();

        $reflection = new \ReflectionClass($this->calledClass);
        if (count($reflection->getConstants()))
        {
            self::$constantsCache[$this->calledClass] = $reflection->getConstants();
        }
    }

    public function displayArrayFormat()
    {
        if ( ! empty(self::$constantsCache)) {

            $listOfConstants = $this->getConstantsList();

            if ($count = count($listOfConstants))
            {
                $str = "[";

                $countEnd = $count--;

                $i = 1;
                foreach ($listOfConstants as $key => $value)
                {
                    if ($i === $countEnd) {
                        $str .= "'$key'";
                    } else {
                        $str .= "'$key',";
                    }
                    $i++;
                }
                $str .= "]";
                return $str;
            }
        }

        return null;
    }

    public function getName($findValue)
    {
        foreach ($this->getConstantsList() as $key => $value)
        {
            if ($findValue === $value) {
                return $key;
            }
        }
    }

    public function getConstantsList()
    {
        if ( ! empty(self::$constantsCache)) {
            return self::$constantsCache[$this->calledClass];
        }

        return null;
    }
}