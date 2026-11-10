<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use InvalidArgumentException;

class SystemAccountService
{
    public const CONNECTION = 'system_account';

    public function pathFor(string $slug): string
    {
        $slug = $this->normalizeSlug($slug);

        return database_path('system_accounts/'.$slug.'.sqlite');
    }

    public function exists(string $slug): bool
    {
        return is_file($this->pathFor($slug));
    }

    public function normalizeSlug(string $slug): string
    {
        $slug = strtolower(trim($slug));

        if (! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $slug)) {
            throw new InvalidArgumentException('Invalid system account slug.');
        }

        return $slug;
    }

    public function connect(string $slug): void
    {
        $slug = $this->normalizeSlug($slug);
        $path = $this->pathFor($slug);

        if (! is_file($path)) {
            throw new InvalidArgumentException("System account [{$slug}] was not found.");
        }

        Config::set('database.connections.'.self::CONNECTION, [
            'driver' => 'sqlite',
            'database' => $path,
            'prefix' => '',
            'foreign_key_constraints' => true,
        ]);

        DB::purge(self::CONNECTION);
        DB::reconnect(self::CONNECTION);
    }

    public function create(string $slug, string $companyName, string $pin): string
    {
        $slug = $this->normalizeSlug($slug);
        $dir = database_path('system_accounts');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $path = $this->pathFor($slug);

        if (is_file($path)) {
            throw new InvalidArgumentException("System account [{$slug}] already exists.");
        }

        touch($path);
        $this->connect($slug);
        $this->migrateSchema();

        DB::connection(self::CONNECTION)->table('settings')->insert([
            'id' => 1,
            'company_name' => $companyName,
            'pin_hash' => Hash::make($pin),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $path;
    }

    public function migrateSchema(): void
    {
        $schema = Schema::connection(self::CONNECTION);

        if (! $schema->hasTable('settings')) {
            $schema->create('settings', function ($table) {
                $table->id();
                $table->string('company_name');
                $table->string('pin_hash');
                $table->timestamps();
            });
        }

        if (! $schema->hasTable('car_entries')) {
            $schema->create('car_entries', function ($table) {
                $table->id();
                $table->string('car_type')->nullable();
                $table->string('entry_date')->nullable();
                $table->integer('cars_count')->default(0);
                $table->decimal('unit_price', 15, 2)->default(0);
                $table->decimal('total_amount', 15, 2)->default(0);
                $table->decimal('transfer_amount', 15, 2)->nullable();
                $table->string('transfer_date')->nullable();
                $table->text('transfer_note')->nullable();
                $table->timestamps();
            });
        }
    }

    public function settings(): object
    {
        return DB::connection(self::CONNECTION)->table('settings')->where('id', 1)->first();
    }

    public function verifyPin(string $pin): bool
    {
        $settings = $this->settings();

        return $settings && Hash::check($pin, $settings->pin_hash);
    }

    public function cars()
    {
        return DB::connection(self::CONNECTION)
            ->table('car_entries')
            ->orderBy('id')
            ->get();
    }

    public function findCar(int $id): ?object
    {
        return DB::connection(self::CONNECTION)
            ->table('car_entries')
            ->where('id', $id)
            ->first();
    }

    public function createCar(array $data): int
    {
        $count = (int) ($data['cars_count'] ?? 0);
        $price = (float) ($data['unit_price'] ?? 0);

        return DB::connection(self::CONNECTION)->table('car_entries')->insertGetId([
            'car_type' => $data['car_type'] ?? null,
            'entry_date' => $data['entry_date'] ?? null,
            'cars_count' => $count,
            'unit_price' => $price,
            'total_amount' => $count * $price,
            'transfer_amount' => $data['transfer_amount'] !== null && $data['transfer_amount'] !== ''
                ? (float) $data['transfer_amount']
                : null,
            'transfer_date' => $data['transfer_date'] ?? null,
            'transfer_note' => $data['transfer_note'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function deleteCar(int $id): bool
    {
        return DB::connection(self::CONNECTION)
            ->table('car_entries')
            ->where('id', $id)
            ->delete() > 0;
    }

    public function stats(): array
    {
        $row = DB::connection(self::CONNECTION)
            ->table('car_entries')
            ->selectRaw('COALESCE(SUM(cars_count), 0) as cars_total')
            ->selectRaw('COALESCE(SUM(total_amount), 0) as amount_total')
            ->selectRaw('COALESCE(SUM(transfer_amount), 0) as transfer_total')
            ->first();

        $carsTotal = (float) ($row->cars_total ?? 0);
        $amountTotal = (float) ($row->amount_total ?? 0);
        $transferTotal = (float) ($row->transfer_total ?? 0);

        return [
            'cars_total' => $carsTotal,
            'amount_total' => $amountTotal,
            'transfer_total' => $transferTotal,
            'balance_with_transfers' => $transferTotal - $amountTotal,
            'balance_without_transfers' => $amountTotal,
        ];
    }

    public function sessionKey(string $slug): string
    {
        return 'system_account_unlocked_'.$this->normalizeSlug($slug);
    }
}
