<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Entities\TransactionAggregateE;
use App\Services\TransactionAggregateS;
use Illuminate\Support\Collection;


/**
 * Class TransactionController.
 */
class TransactionController extends Controller
{
    /** @var TransactionAggregateS TransactionAggregateS */
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
     * @return mixed
     */
    public function reports()
    {
        return view('reports');
    }

    /**
     * @param $symbol
     *
     * @return mixed
     */
    public function getBySymbol($symbol)
    {
        // derive TransactionAggregateE collection
        $CollectionAggregateE = $this
            ->transactionAggregateS
            ->getBySymbol($symbol);

        // convert to Jsonable return type
        return $this->convertToJsonableType($CollectionAggregateE);
    }

    public function getAllSymbols()
    {
        // derive TransactionAggregateE collection
        $CollectionAggregateE = $this
            ->transactionAggregateS
            ->getBySymbol();
    }


    /**
     * @param Collection $CollectionAggregateE
     * @return array
     */
    protected function convertToJsonableType(Collection $CollectionAggregateE): array
    {
        $data = [];

        // convert the collection to an array
        $transactions = $CollectionAggregateE->all();

        // convert the array a jsonable return type
        /** @var TransactionAggregateE $transaction */
        foreach ($transactions as $transaction) {
            $data[] = $transaction->toArray();
        }

        return $data;
    }
}
