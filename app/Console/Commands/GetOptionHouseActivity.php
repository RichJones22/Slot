<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Premise\Utilities\PremiseUtilities;

/**
 * Class GetOptionHouseActivity.
 */
class GetOptionHouseActivity extends Command
{
    const DOWNLOADS_DIR = '/public/downloads';
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
     * GetOptionHouseActivity constructor.
     */
    public function __construct()
    {
        parent::__construct();
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
        if (empty($files))
        {
            return $this;
        }

        foreach($files as $file)
        {
            dump($file);
        }





        // 1. check to see if file(s) exist.
        // 2. process the file(s).
        // 3. move the processed file into an archive dir.

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
        $path = app()->basePath() . self::DOWNLOADS_DIR;

        // get files.
        $files = PremiseUtilities::getSplFileInfoForFilesInDirectory($path, 'csv');

        // early exit if we did not receive any files.
        if (empty($files)) {
            $this->line('success 1 -- no file(s) to process');
        } else {
            /** @var \DirectoryIterator $file */
            foreach ($files as $file) {
                if (!strncmp(self::FILE_NAME_BEGINS_WITH, $file->getFilename(), strlen(self::FILE_NAME_BEGINS_WITH))) {
                    $result[] = $file->getPathname();
                }
            }

            if (empty($result))
            {
                $this->line('success 2 -- no file(s) to process');
            }
        }

        return $result;
    }
}
