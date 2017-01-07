<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use DB;

/**
 * Class SymbolService
 * @package App\Services
 */
class SymbolService
{
    /** @var string  */
    public $fromDate='1900-01-01';

    /**
     * @return Collection
     */
    public function symbolsUnique(): Collection
    {
        $symbolCollection = DB::table('options_house_transaction')
            ->select('underlier_symbol')
            ->orderBy('underlier_symbol', 'asc')
            ->groupBy('underlier_symbol')
            ->where('underlier_symbol', '<>', '')
            ->where('close_date', '>', $this->fromDate)
            ->get();

        return $symbolCollection;
    }

    /**
     * @param string|null $fromDate
     * @return $this
     */
    public function setFromDate(string $fromDate = null)
    {
        if (!empty($fromDate)) {
            $this->fromDate = $fromDate;
        }

        return $this;
    }
}