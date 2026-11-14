<?php

namespace App\Console\Commands;

use App\Services\SystemAccountService;
use Illuminate\Console\Command;

class RestoreSystemAccount extends Command
{
    protected $signature = 'system-account:restore
                            {slug : Company slug to restore from trash}';

    protected $description = 'Restore a soft-deleted system account company from emergency trash';

    public function handle(SystemAccountService $accounts): int
    {
        $slug = $this->argument('slug');

        try {
            $restored = $accounts->restoreCompany($slug);
        } catch (\InvalidArgumentException $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info("Restored system account [{$restored}]");
        $this->line(url('/system-account/'.$restored));

        return self::SUCCESS;
    }
}
