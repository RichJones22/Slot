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
     * @param $year
     */
    public function getByYear($year)
    {
        $where1 = 'substring(close_date,1,4)';
        $where2 = ['Trade'];

        $totalSum = 0;

        $transactions = DB::table('options_house_transaction')
            ->select('close_date',
                'underlier_symbol',
                'option_side',
                'option_quantity',
                'strike_price',
                'expiration',
                'amount')
            ->whereIn('trade_type', $where2)
            ->where(DB::raw($where1), $year)
            ->get();

        foreach ($transactions as $transaction) {
            echo $transaction->close_date.' '
                .$transaction->underlier_symbol.' '
                .$transaction->option_side.' '
                .$transaction->option_quantity.' '
                .$transaction->strike_price.' '
                .$transaction->expiration.' '
                .$transaction->amount.'</br>';

            $totalSum += $transaction->amount;
        }

        echo "</br> Symbol total: $totalSum".'</br>';
    }

    /**
     * @param $year
     * @param $symbol
     */
    public function getByYearBySymbol($year, $symbol)
    {
        $where1 = 'substring(close_date,1,4)';
        $where2 = ['Trade'];

        $totalSum = 0;

        $transactions = DB::table('options_house_transaction')
            ->select('close_date', 'underlier_symbol', 'option_side', 'option_quantity', 'symbol', 'amount')
            ->whereIn('trade_type', $where2)
            ->where(DB::raw($where1), $year)
            ->where('underlier_symbol', $symbol)
            ->orderBy('transaction_id', 'option_side')
            ->get();

        foreach ($transactions as $transaction) {
            echo $transaction->close_date.' '
                .$transaction->underlier_symbol.' '
                .$transaction->option_side.' '
                .$transaction->option_quantity.' '
                .$transaction->symbol.' '
                .$transaction->amount.'</br>';

            $totalSum += $transaction->amount;
        }

        echo "</br> Symbol total: $totalSum".'</br>';
    }

    /**
     * @param $symbol
     */
    public function getBySymbol($symbol)
    {
        $where2 = ['Trade'];

        $totalSum = 0;

        $transactions = DB::table('options_house_transaction')
            ->select('close_date',
                'underlier_symbol',
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
            ->orderBy('close_date', 'desc')
            ->orderBy('option_side', 'desc')
            ->get();

        // reverse the order for better readability.
        $transactions = $transactions->reverse();

        // consolidate transactions
        $transactions = $this->consolidateTransactions($transactions);

        // echo output.
        foreach ($transactions as $transaction) {
            echo $transaction->close_date.' '
                .$transaction->underlier_symbol.' '
                .$transaction->option_side.' '
                .$transaction->option_quantity.' '
                .$transaction->strike_price.' '
                .$transaction->expiration.' '
                .$transaction->symbol.' '
                .$transaction->amount.'</br>';

            $totalSum += $transaction->amount;

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
                        dump('im here');
                    }
                }
            } elseif ($transaction->option_side === 'SELL') {
                $counts = DB::table('options_house_transaction')
                    ->select(DB::raw('count(*) as count'))
                    ->where('symbol', $transaction->symbol)
                    ->whereIn('trade_type', $where2)
                    ->get();

                foreach ($counts as $count) {
                    if ($count->count === 1) {
                        dump('im here');
                    }
                }
            }
        }

        echo "</br> Symbol total: $totalSum".'</br>';
    }

    /**
     * @param $yearMonth
     *
     * @internal param Request $request
     */
    public function getByYearMonth($yearMonth)
    {
        $where1 = 'substring(close_date,1,7)';
        $where2 = 'Trade';

        $totalSum = 0;

        $symbols = DB::table('options_house_transaction')
            ->select('underlier_symbol')
            ->where('trade_type', $where2)
            ->where(DB::raw($where1), $yearMonth)
            ->groupBy('underlier_symbol')
            ->get();

        foreach ($symbols as $symbol) {
            $sum = DB::table('options_house_transaction')
                ->select(DB::raw('sum(amount) as sum'))
                ->where('trade_type', $where2)
                ->where(DB::raw($where1), $yearMonth)
                ->where('underlier_symbol', $symbol->underlier_symbol)
                ->first();

            echo $yearMonth.' '.$symbol->underlier_symbol.' '.$sum->sum.'</br>';

            $totalSum += $sum->sum;
        }

        echo "</br> Monthly total: $totalSum".'</br>';
    }

    /**
     * @param $yearMonth
     * @param $symbol
     */
    public function getByYearMonthBySymbol($yearMonth, $symbol)
    {
        $where1 = 'substring(close_date,1,7)';
        $where2 = 'Trade';

        $totalSum = 0;

        $transactions = DB::table('options_house_transaction')
            ->select('close_date',
                'underlier_symbol',
                'option_side',
                'option_quantity',
                'strike_price',
                'expiration',
                'amount')
            ->where('trade_type', $where2)
            ->where(DB::raw($where1), $yearMonth)
            ->where('underlier_symbol', $symbol)
            ->orderBy('transaction_id', 'option_side')
            ->get();

        foreach ($transactions as $transaction) {
            echo $transaction->close_date.' '
                .$transaction->underlier_symbol.' '
                .$transaction->option_side.' '
                .$transaction->option_quantity.' '
                .$transaction->strike_price.' '
                .$transaction->expiration.' '
                .$transaction->amount.'</br>';

            $totalSum += $transaction->amount;
        }

        echo "</br> Symbol total: $totalSum".'</br>';
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
                ->where('close_date', $transaction->close_date)
                ->where('underlier_symbol', $transaction->underlier_symbol)
                ->where('option_side', $transaction->option_side)
                ->get();

            foreach ($counts as $count) {
                if ($count->count > 1) {
                    // pull out the group.
                    $toSum = $transactions->filter(function ($x) use ($transaction) {
                        if ($x->close_date === $transaction->close_date &&
                            $x->underlier_symbol === $transaction->underlier_symbol &&
                            $x->option_side === $transaction->option_side) {
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
                            $x->option_side !== $transaction->option_side) {
                            return $x;
                        }

                        return false;
                    });

                    // add the summed element back to the array
                    $newArray[] = $toAddBack;

                    // place it the correct order.
                    $transactions = $newArray->sort();

                    // break of this foreach loop
                    break;
                }
            }
        }

        return $transactions;
    }
}
