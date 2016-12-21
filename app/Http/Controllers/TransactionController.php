<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Collection;

/**
 * Class TransactionController.
 */
class TransactionController extends Controller
{
    /**
     * @return mixed
     */
    public function reports()
    {
        return view('reports');
    }

    /**
     * @param $symbol
     */
    public function getBySymbol($symbol)
    {
        $where2 = ['Trade'];

        $tradeSum = 0;
        $tradeCount = 0;
        $totalSum = 0;

        $transactions = DB::table('options_house_transaction')
            ->select(
                'close_date',
                'underlier_symbol',
                'position_state',
                'option_side',
                'option_quantity',
                'strike_price',
                'expiration',
                'amount',
                'symbol',
                'transaction_id')
            ->whereIn('trade_type', $where2)
            ->where('underlier_symbol', $symbol)
            ->where('security_type', 'OPTION')
            ->orderBy('close_date', 'asc')
            ->orderBy('option_side', 'asc')
            ->orderBy('expiration', 'asc')
            ->get();

        // cull single buy options; this technique is for selling and rolling sold options
        $transactions = $this->findRemoveSingleBuyItem($transactions);

        // consolidate transactions
        $transactions = $this->consolidateTransactions($transactions);

        // echo output.
        $i = 1;
        $count = $transactions->count();
        foreach ($transactions as $transaction) {
            echo $transaction->close_date.' '
                .$transaction->underlier_symbol.' '
                .$transaction->position_state.' '
                .$transaction->option_side.' '
                .$transaction->option_quantity.' '
                .$transaction->strike_price.' '
                .$transaction->expiration.' '
                .$transaction->amount.'</br>';

            $tradeSum += $transaction->amount;
            $tradeCount += $transaction->option_quantity;
            $totalSum += $transaction->amount;

            // check if trade ended
            $this->didTradeEnd($transaction, $where2, $count, $i, $tradeSum);
            ++$i;
        }

        echo "</br> Symbol total: $totalSum".'</br>';
    }

    /**
     * @param Collection $transactions
     *
     * @return Collection
     */
    protected function findRemoveSingleBuyItem(Collection $transactions): Collection
    {
        $transactions = $transactions->sort(function ($a, $b) {
            if ($a->expiration === $b->expiration) {
                return 0;
            }

            return ($a->expiration < $b->expiration) ? -1 : 1;
        });

        $transactions = $this->removeSingleBuys($transactions);

        return $transactions;
    }

    /**
     * @param Collection $transactions
     *
     * @return Collection
     */
    protected function removeSingleBuys(Collection $transactions): Collection
    {
        $where2 = ['Trade'];

        foreach ($transactions as $transaction) {
            if ($transaction->option_side === 'BUY') {
                $counts = DB::table('options_house_transaction')
                    ->select(DB::raw('count(*) as count'))
                    ->whereIn('trade_type', $where2)
                    ->where('expiration', $transaction->expiration)
                    ->where('underlier_symbol', $transaction->underlier_symbol)
                    ->where('security_type', 'OPTION')
                    ->get();

                foreach ($counts as $count) {
                    // check if we have a group to consolidate
                    if ($count->count === 1) {
                        // pull out the group.
                        $transactions = $transactions->filter(function ($x) use ($transaction) {
                            if ($x->transaction_id !== $transaction->transaction_id) {
                                return $x;
                            }

                            return false;
                        });
                    }
                }
            }
        }

        return $transactions;
    }

    /**
     * groups partial fills as one aggregate transaction; much easier to read this way.
     *
     * @param Collection $transactions
     *
     * @return Collection
     */
    protected function consolidateTransactions(Collection $transactions): Collection
    {
        foreach ($transactions as $transaction) {
            $counts = DB::table('options_house_transaction')
                ->select(DB::raw('count(*) as count'))
                ->where('expiration', $transaction->expiration)
                ->where('underlier_symbol', $transaction->underlier_symbol)
                ->where('option_side', $transaction->option_side)
                ->where('security_type', 'OPTION')
                ->get();

            foreach ($counts as $count) {
                // check if we have a group to consolidate
                if ($count->count > 1) {
                    // consolidate the group
                    $transactions = $this->consolidateGroup($transactions, $transaction);

                    break;
                }
            }
        }

        return $transactions;
    }

    /**
     * collection manipulation:
     * - squash the group down to a single element
     * - sum the quantity and amount values
     * - place squashed element back on collection
     * - sort the collection.
     *
     * @param Collection $transactions
     * @param $transaction
     *
     * @return Collection
     */
    protected function consolidateGroup(Collection $transactions, $transaction): Collection
    {
        // pull out the group.
        $toSum = $transactions->filter(function ($x) use ($transaction) {
            if ($x->close_date === $transaction->close_date &&
                $x->underlier_symbol === $transaction->underlier_symbol &&
                $x->option_side === $transaction->option_side
            ) {
                return $x;
            }

            return false;
        });

        // sum the amounts
        $sumAmount = $toSum->reduce(function ($carry, $item) {
            return $carry += $item->amount;
        });

        // sum the quantities
        $sumQuantity = $toSum->reduce(function ($carry, $item) {
            return $carry += $item->option_quantity;
        });

        // create the summed element
        $toAddBack = $toSum->first();
        $toAddBack->amount = $sumAmount;
        $toAddBack->option_quantity = $sumQuantity;

        // remove the group from the array
        $newArray = $transactions->filter(function ($x) use ($transaction) {
            if ($x->close_date !== $transaction->close_date ||
                $x->underlier_symbol !== $transaction->underlier_symbol ||
                $x->option_side !== $transaction->option_side
            ) {
                return $x;
            }

            return false;
        });

        // add the summed element back to the array
        $newArray[] = $toAddBack;

        // sort the array.
        $transactions = $newArray->sort();

        return $transactions;
    }

    /**
     * @param $transaction
     * @param $where2
     * @param $count
     * @param $i
     * @param $tradeSum
     */
    protected function didTradeEnd($transaction, $where2, $count, $i, &$tradeSum)
    {
        // determine if trade has ended.
        if ($transaction->option_side === 'BUY') {
            $counts = DB::table('options_house_transaction')
                ->select(DB::raw('count(*) as count'))
                ->where('close_date', $transaction->close_date)
                ->where('underlier_symbol', $transaction->underlier_symbol)
                ->where('option_side', 'SELL')
                ->where('security_type', 'OPTION')
                ->whereIn('trade_type', $where2)
                ->get();

            foreach ($counts as $count) {
                if ($count->count === 0) {
                    echo "Trade win/lose: $tradeSum".'</br></br>';
                    $tradeSum = 0;
                }
            }
        } elseif ($transaction->option_side === 'SELL') {
            if ($count !== $i) {
                $counts = DB::table('options_house_transaction')
                    ->select(DB::raw('count(*) as count'))
                    ->where('symbol', $transaction->symbol)
                    ->where('security_type', 'OPTION')
                    ->whereIn('trade_type', $where2)
                    ->get();

                foreach ($counts as $count) {
                    if ($count->count === 1) {
                        echo "Trade win/lose: $tradeSum".'</br></br>';
                        $tradeSum = 0;
                    }
                }
            }
        }
    }
}
