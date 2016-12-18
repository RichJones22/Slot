<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\OptionsHouseTransaction;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Premise\Utilities\PremiseUtilities;

/**
 * Class GetOptionHouseActivity.
 */
class GetOptionHouseActivity extends Command
{
    /**
     * incoming download files.
     */
    const DOWNLOADS_DIR = '/public/downloads';
    /**
     * specific file fof the command.
     */
    const FILE_NAME_BEGINS_WITH = 'AccountHistoryReport';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'optionsHouse:get-activity';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'loads Options House transaction activity';
    /**
     * @var Model OptionsHouseTransaction
     */
    private $optionsHouseTransactionM;

    /**
     * GetOptionHouseActivity constructor.
     *
     * @param OptionsHouseTransaction $optionsHouseTransaction
     */
    public function __construct(OptionsHouseTransaction $optionsHouseTransaction)
    {
        parent::__construct();
        $this->optionsHouseTransactionM = $optionsHouseTransaction;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get files; early exist if we don't have any to process.
        $files = $this->getFiles();
        if (empty($files)) {
            return $this;
        }

        foreach ($files as $file) {
            // derive transactions array per file.
            $transactions = $this->createTransactionsArray($file);
            if (empty($transactions)) {
                return $this;
            }

            // persist transactions to db.
            $this->persistTransactions($transactions);
        }

        return $this;
    }

    /**
     * @return array|\DirectoryIterator|string
     */
    protected function getFiles()
    {
        // return result.
        $result = [];

        // path where files are located.
        $path = app()->basePath().self::DOWNLOADS_DIR;

        // get files.
        $files = PremiseUtilities::getSplFileInfoForFilesInDirectory($path, 'csv');

        // early exit if we did not receive any files.
        if (empty($files)) {
            $this->line('success 1 -- no file(s) to process');
        } else {
            /** @var \DirectoryIterator $file */
            foreach ($files as $file) {
                if ( ! strncmp(self::FILE_NAME_BEGINS_WITH, $file->getFilename(), strlen(self::FILE_NAME_BEGINS_WITH))) {
                    $result[] = $file->getPathname();
                }
            }

            if (empty($result)) {
                $this->line('success 2 -- no file(s) to process');
            }
        }

        return $result;
    }

    /**
     * @param $file
     *
     * @return array
     */
    protected function createTransactionsArray($file): array
    {
        $array = $fields = [];
        $i = 0;

        // open file.
        $handle = fopen($file, 'r');
        if ( ! $handle) {
            $this->error('error opening '.$file.' for read');

            return [];
        }

        // remove file identifier records
        fgetcsv($handle, 4096);
        fgetcsv($handle, 4096);

        if ($handle) {
            while (($row = fgetcsv($handle, 4096)) !== false) {
                if (empty($fields)) {
                    $fields = $row;
                    continue;
                }
                foreach ($row as $k => $value) {
                    $array[$i][trim($fields[$k])] = $value;
                }
                ++$i;
            }
            if ( ! feof($handle)) {
                $this->error('Error: unexpected fgetcsv() fail');

                return [];
            }
            fclose($handle);

            return $array;
        }

        return $array;
    }

    /**
     * @param $transactions
     */
    protected function persistTransactions($transactions)
    {
        // write records to the db.
        foreach ($transactions as $transaction) {
            if ((int) $transaction['TransactionID'] === 0) {
                continue; // don't process 0 transaction_id records.
            }

            // check if transaction_id exists.
            /** @var Model $found */
            $found = DB::table('options_house_transaction')
                ->where('transaction_id', $transaction['TransactionID'])
                ->first();

            // save record if transaction DOES NOT exists
            if ( ! $found) {
                $this->saveRecord($transaction);
            }
        }
    }

    /**
     * @param $transaction
     */
    protected function saveRecord($transaction)
    {
        $this->optionsHouseTransactionM = new $this->optionsHouseTransactionM();

        $this->optionsHouseTransactionM->setTransactionId($transaction['TransactionID']);
        $this->optionsHouseTransactionM->setCloseDate((new Carbon($transaction['Date']))->format('Y-m-d'));
        $this->optionsHouseTransactionM->setCloseTime((new Carbon($transaction['Time']))->format('h:i:s'));
        $this->optionsHouseTransactionM->setTradeType($transaction['Type']);
        $this->optionsHouseTransactionM->setDescription($transaction['Description']);
        $this->optionsHouseTransactionM->setOptionType($transaction['Type']);
        $this->optionsHouseTransactionM->setStrikePrice($transaction['Strike']);
        $this->optionsHouseTransactionM->setOptionSide($transaction['Side']);
        $this->optionsHouseTransactionM->setOptionQuantity($transaction['Quantity']);
        $this->optionsHouseTransactionM->setSymbol($transaction['Symbol']);
        $this->optionsHouseTransactionM->setPricePerUnit($transaction['Price per unit']);
        $this->optionsHouseTransactionM->setUnderlierSymbol($transaction['Underlier Symbol']);
        $this->optionsHouseTransactionM->setFee($transaction['Fee']);
        $this->optionsHouseTransactionM->setCommission($transaction['Commission']);
        $this->optionsHouseTransactionM->setAmount($transaction['Amount']);
        $this->optionsHouseTransactionM->setSecurityType($transaction['Security Type']);
        $this->optionsHouseTransactionM->setExpiration((new Carbon($transaction['Expiration Date']))->format('Y-m-d'));
        $this->optionsHouseTransactionM->setSecurityDescription($transaction['Security Description']);
        $this->optionsHouseTransactionM->setPositionState($transaction['Open or Close']);
        $this->optionsHouseTransactionM->setDeliverables($transaction['Deliverables']);
        $this->optionsHouseTransactionM->setMarketStatistics($transaction['Market Statistics']);
        $this->optionsHouseTransactionM->setTradeJournalNotes($transaction['Trade Journal notes']);

        $this->optionsHouseTransactionM->save();
    }
}
