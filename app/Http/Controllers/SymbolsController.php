<?php

namespace App\Http\Controllers;

use App\Services\SymbolService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Services\TransactionAggregateS;
use DB;
use Illuminate\Support\Collection;


/**
 * Class SymbolsController
 * @package App\Http\Controllers
 */
class SymbolsController extends Controller
{
    private $symbolService;

    /**
     * SymbolsController constructor.
     * @param SymbolService $symbolService
     */
    public function __construct(SymbolService $symbolService)
    {
        $this->symbolService = $symbolService;
    }


    /**
     * @return array
     */
    public function symbolsUnique()
    {
        $symbolCollection = $this->symbolService->symbolsUnique();

        // convert the collection to an array
        return $this->convertToJsonableType($symbolCollection);
    }

    /**
     * @param Collection $transactionCollection
     * @return array
     */
    protected function convertToJsonableType(collection $transactionCollection): array
    {
        $data = [];

        $transactions = $transactionCollection->all();

        foreach ($transactions as $transaction) {
            $tmp = [];
            $tmp['text'] = $transaction->underlier_symbol;
            $tmp['value'] = $transaction->underlier_symbol;

            $data[] = $tmp;
        }

        return $data;
    }
}
