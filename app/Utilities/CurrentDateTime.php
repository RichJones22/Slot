<?php

namespace App\Utilities;


use Carbon\Carbon;


/**
 * Class CurrentDateTime
 * @package App\Utilities
 */
class CurrentDateTime
{
    private static $inst=null;
    /**
     * @var Carbon
     */
    private $carbon;

    /**
     * CurrentDateTime constructor.
     * @param Carbon $carbon
     */
    public function __construct(Carbon $carbon)
    {
        $this->carbon = $carbon;
    }

    /**
     * @return CurrentDateTime|null
     */
    public static function new()
    {
        if (self::$inst === null) {
            self::$inst = new self(Carbon::now());
        }

        return self::$inst;
    }

    /**
     * @return CurrentDateTime|string
     */
    public function currentDate()
    {
        $saveDate = new Carbon($this->carbon);

        $returnDate = $this->carbon->format('Y-m-d');

        $this->carbon = $saveDate;

        return $returnDate;
    }

    /**
     * @param int $days
     * @return string
     */
    public function daysBack(int $days)
    {
        $saveDate = new Carbon($this->carbon);

        $returnDate = $this->carbon->subDays($days)->format('Y-m-d');

        $this->carbon = $saveDate;

        return $returnDate;
    }
}