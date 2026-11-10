<?php

namespace App\Console\Commands;

use App\Services\SystemAccountExcelService;
use App\Services\SystemAccountService;
use Illuminate\Console\Command;

class ImportSystemAccountExcel extends Command
{
    protected $signature = 'system-account:import
                            {slug : Account slug}
                            {path : Absolute path to xlsx file}';

    protected $description = 'Replace car entries in a system account from an Excel file';

    public function handle(SystemAccountService $accounts, SystemAccountExcelService $excel): int
    {
        $slug = $this->argument('slug');
        $path = $this->argument('path');

        try {
            $accounts->connect($slug);
            $count = $excel->importFromPath($path);
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info("Imported {$count} rows into [{$slug}]");
        $this->line(json_encode($accounts->stats(), JSON_UNESCAPED_UNICODE));

        return self::SUCCESS;
    }
}
