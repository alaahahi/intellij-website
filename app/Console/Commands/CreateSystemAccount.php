<?php

namespace App\Console\Commands;

use App\Services\SystemAccountService;
use Illuminate\Console\Command;

class CreateSystemAccount extends Command
{
    protected $signature = 'system-account:create
                            {slug : Account slug e.g. bar-khor}
                            {--name= : Company display name}
                            {--pin=1234 : Unlock PIN}';

    protected $description = 'Create a new isolated SQLite system account';

    public function handle(SystemAccountService $accounts): int
    {
        $slug = $this->argument('slug');
        $name = $this->option('name') ?: $slug;
        $pin = (string) $this->option('pin');

        try {
            $path = $accounts->create($slug, $name, $pin);
        } catch (\Throwable $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->info("Created system account [{$slug}] at {$path}");
        $this->line("PIN: {$pin}");

        return self::SUCCESS;
    }
}
