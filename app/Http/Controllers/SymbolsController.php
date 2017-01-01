<?php

namespace App\Http\Controllers;

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
    private $transactionAggregateS;

    /**
     * TransactionController constructor.
     *
     * @param TransactionAggregateS $aggregateS
     */
    public function __construct(TransactionAggregateS $aggregateS)
    {
        $this->transactionAggregateS = $aggregateS;
    }


    /**
     * @return array
     */
    public function symbolsUnique()
    {

        /** @var Model $transactions */
        $transactionCollection = DB::table('options_house_transaction')
            ->select('underlier_symbol')
            ->orderBy('underlier_symbol', 'asc')
            ->groupBy('underlier_symbol')
            ->where('underlier_symbol', '<>', '')
            ->get();

        // convert the collection to an array
        return $this->convertToJsonableType($transactionCollection);
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
            $inner = [];
            $inner['text'] = $transaction->underlier_symbol;
            $inner['value'] = $transaction->underlier_symbol;

            $data[] = $inner;
        }

        return $data;
    }
}
