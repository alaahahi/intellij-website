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
        return database_path('system_accounts/'.$this->normalizeSlug($slug).'.sqlite');
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
        $this->migrateSchema();
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

        DB::connection(self::CONNECTION)->table('settings')->insert([
            'id' => 1,
            'company_name' => $companyName,
            'pin_hash' => Hash::make($pin),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $path;
    }

    public function recreateFresh(string $slug, string $companyName, string $pin): string
    {
        $slug = $this->normalizeSlug($slug);
        $path = $this->pathFor($slug);
        if (is_file($path)) {
            @unlink($path);
        }

        return $this->create($slug, $companyName, $pin);
    }

    public function trashPath(): string
    {
        $dir = database_path('system_accounts/trash');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        return $dir;
    }

    /**
     * Soft-delete: move SQLite to trash for emergency restore (does not destroy data).
     */
    public function deleteCompany(string $slug): string
    {
        $slug = $this->normalizeSlug($slug);
        $path = $this->pathFor($slug);

        if (! is_file($path)) {
            throw new InvalidArgumentException("System account [{$slug}] was not found.");
        }

        $name = $slug;
        try {
            $pdo = new \PDO('sqlite:'.$path);
            $row = $pdo->query('SELECT company_name FROM settings WHERE id = 1')->fetch(\PDO::FETCH_ASSOC);
            if (! empty($row['company_name'])) {
                $name = (string) $row['company_name'];
            }
            $pdo = null;
        } catch (\Throwable) {
            // keep slug
        }

        DB::purge(self::CONNECTION);

        $stamp = now()->format('Ymd-His');
        $trashDir = $this->trashPath();
        $dest = $trashDir.DIRECTORY_SEPARATOR.$slug.'__'.$stamp.'.sqlite';

        if (! @rename($path, $dest)) {
            if (! @copy($path, $dest) || ! @unlink($path)) {
                throw new InvalidArgumentException("تعذر نقل الحساب إلى سلة الطوارئ [{$slug}].");
            }
        }

        foreach (['-wal', '-shm', '-journal'] as $suffix) {
            $extra = $path.$suffix;
            if (is_file($extra)) {
                @rename($extra, $dest.$suffix) || @unlink($extra);
            }
        }

        file_put_contents(
            $trashDir.DIRECTORY_SEPARATOR.$slug.'__'.$stamp.'.json',
            json_encode([
                'slug' => $slug,
                'name' => $name,
                'deleted_at' => now()->toIso8601String(),
                'sqlite' => basename($dest),
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );

        return $name;
    }

    /**
     * Restore latest soft-deleted company dump for a slug.
     */
    public function restoreCompany(string $slug): string
    {
        $slug = $this->normalizeSlug($slug);
        if ($this->exists($slug)) {
            throw new InvalidArgumentException("الشركة [{$slug}] موجودة مسبقاً.");
        }

        $trashDir = $this->trashPath();
        $matches = glob($trashDir.DIRECTORY_SEPARATOR.$slug.'__*.sqlite') ?: [];
        if (count($matches) === 0) {
            throw new InvalidArgumentException("لا توجد نسخة طوارئ للشركة [{$slug}].");
        }

        rsort($matches);
        $src = $matches[0];
        $dest = $this->pathFor($slug);

        if (! @rename($src, $dest)) {
            if (! @copy($src, $dest)) {
                throw new InvalidArgumentException("تعذر استعادة الحساب [{$slug}].");
            }
            @unlink($src);
        }

        $meta = preg_replace('/\.sqlite$/', '.json', $src);
        if (is_file($meta)) {
            @unlink($meta);
        }

        return $slug;
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

        if (! $schema->hasTable('batches')) {
            $schema->create('batches', function ($table) {
                $table->id();
                $table->string('car_type')->nullable();
                $table->string('entry_date')->nullable();
                $table->integer('cars_count')->default(0);
                $table->decimal('unit_price', 15, 2)->default(0);
                $table->decimal('total_amount', 15, 2)->default(0);
                $table->timestamps();
            });
        }

        if (! $schema->hasTable('vehicles')) {
            $schema->create('vehicles', function ($table) {
                $table->id();
                $table->unsignedBigInteger('batch_id');
                $table->integer('seq')->default(1);
                $table->string('model_name')->nullable();
                $table->string('color')->nullable();
                $table->integer('model_year')->nullable();
                $table->string('vin')->nullable();
                $table->timestamps();
                $table->index('batch_id');
            });
        }

        if ($schema->hasTable('vehicles')) {
            if (! $schema->hasColumn('vehicles', 'color')) {
                $schema->table('vehicles', function ($table) {
                    $table->string('color')->nullable();
                });
            }
            if (! $schema->hasColumn('vehicles', 'model_year')) {
                $schema->table('vehicles', function ($table) {
                    $table->integer('model_year')->nullable();
                });
            }
        }

        if (! $schema->hasTable('remittances')) {
            $schema->create('remittances', function ($table) {
                $table->id();
                $table->decimal('amount', 15, 2)->default(0);
                $table->string('transfer_date')->nullable();
                $table->text('note')->nullable();
                $table->timestamps();
            });
        }

        $this->migrateLegacyIfNeeded();
    }

    protected function migrateLegacyIfNeeded(): void
    {
        $schema = Schema::connection(self::CONNECTION);
        if (! $schema->hasTable('car_entries')) {
            return;
        }

        $batchCount = DB::connection(self::CONNECTION)->table('batches')->count();
        if ($batchCount > 0) {
            return;
        }

        $rows = DB::connection(self::CONNECTION)->table('car_entries')->orderBy('id')->get();
        foreach ($rows as $row) {
            $batchId = DB::connection(self::CONNECTION)->table('batches')->insertGetId([
                'car_type' => $row->car_type,
                'entry_date' => $row->entry_date,
                'cars_count' => (int) $row->cars_count,
                'unit_price' => (float) $row->unit_price,
                'total_amount' => (float) $row->total_amount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (isset($row->transfer_amount) && $row->transfer_amount !== null && (float) $row->transfer_amount != 0.0) {
                DB::connection(self::CONNECTION)->table('remittances')->insert([
                    'amount' => (float) $row->transfer_amount,
                    'transfer_date' => $row->transfer_date ?? null,
                    'note' => $row->transfer_note ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Keep reference unused for now
            unset($batchId);
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

    public function sessionKey(string $slug): string
    {
        return 'system_account_unlocked_'.$this->normalizeSlug($slug);
    }

    /**
     * @return array<int, array{slug: string, name: string}>
     */
    public function listCompanies(): array
    {
        $dir = database_path('system_accounts');
        if (! is_dir($dir)) {
            return [];
        }

        $companies = [];
        foreach (glob($dir.DIRECTORY_SEPARATOR.'*.sqlite') ?: [] as $file) {
            $slug = basename($file, '.sqlite');
            if ($slug === '' || str_starts_with($slug, '.')) {
                continue;
            }

            $name = $slug;
            try {
                $pdo = new \PDO('sqlite:'.$file);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $row = $pdo->query('SELECT company_name FROM settings WHERE id = 1')->fetch(\PDO::FETCH_ASSOC);
                if (! empty($row['company_name'])) {
                    $name = (string) $row['company_name'];
                }
            } catch (\Throwable) {
                // keep slug as name
            }

            $companies[] = [
                'slug' => $slug,
                'name' => $name,
                'url' => url('/system-account/'.$slug),
            ];
        }

        usort($companies, function ($a, $b) {
            // شركة برج الخور أولاً إن وُجدت
            if ($a['slug'] === 'burj-al-khur') {
                return -1;
            }
            if ($b['slug'] === 'burj-al-khur') {
                return 1;
            }

            return strcmp($a['name'], $b['name']) ?: strcmp($a['slug'], $b['slug']);
        });

        return $companies;
    }

    /**
     * Search VIN / chassis across all company SQLite ledgers.
     *
     * @return array<int, array<string, mixed>>
     */
    public function searchVinAcrossCompanies(string $query, int $limit = 40): array
    {
        $needle = strtoupper(preg_replace('/\s+/', '', trim($query)) ?? '');
        if (strlen($needle) < 3) {
            return [];
        }

        $results = [];
        foreach ($this->listCompanies() as $company) {
            $path = $this->pathFor($company['slug']);
            if (! is_file($path)) {
                continue;
            }

            try {
                $pdo = new \PDO('sqlite:'.$path);
                $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $hasVehicles = (bool) $pdo->query(
                    "SELECT 1 FROM sqlite_master WHERE type='table' AND name='vehicles'"
                )->fetchColumn();
                if (! $hasVehicles) {
                    continue;
                }

                $stmt = $pdo->prepare(
                    "SELECT v.id as vehicle_id, v.vin, v.model_name, v.color, v.model_year, v.seq,
                            v.batch_id, b.car_type, b.entry_date
                     FROM vehicles v
                     LEFT JOIN batches b ON b.id = v.batch_id
                     WHERE REPLACE(UPPER(COALESCE(v.vin, '')), ' ', '') LIKE :q
                     ORDER BY v.id DESC
                     LIMIT 25"
                );
                $stmt->execute([':q' => '%'.$needle.'%']);
                while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                    $results[] = [
                        'company_slug' => $company['slug'],
                        'company_name' => $company['name'],
                        'company_url' => $company['url'],
                        'batch_id' => (int) ($row['batch_id'] ?? 0),
                        'vehicle_id' => (int) ($row['vehicle_id'] ?? 0),
                        'vin' => (string) ($row['vin'] ?? ''),
                        'model_name' => $row['model_name'] ?? null,
                        'color' => $row['color'] ?? null,
                        'model_year' => $row['model_year'] ?? null,
                        'seq' => (int) ($row['seq'] ?? 0),
                        'car_type' => $row['car_type'] ?? null,
                        'entry_date' => $row['entry_date'] ?? null,
                    ];
                    if (count($results) >= $limit) {
                        return $results;
                    }
                }
            } catch (\Throwable) {
                continue;
            }
        }

        return $results;
    }

    public function makeSlugFromName(string $name, ?string $preferred = null): string
    {
        if ($preferred) {
            return $this->normalizeSlug($preferred);
        }

        $ascii = strtolower(trim($name));
        $ascii = preg_replace('/[^a-z0-9]+/i', '-', $ascii) ?: '';
        $ascii = trim($ascii, '-');

        if ($ascii === '' || ! preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $ascii)) {
            $ascii = 'company-'.substr(bin2hex(random_bytes(3)), 0, 6);
        }

        $base = $ascii;
        $i = 2;
        while ($this->exists($ascii)) {
            $ascii = $base.'-'.$i;
            $i++;
        }

        return $ascii;
    }

    // ── Batches (أسطر المجموعات) ──

    public function batches()
    {
        $batches = DB::connection(self::CONNECTION)->table('batches')->orderBy('id')->get();
        $counts = DB::connection(self::CONNECTION)
            ->table('vehicles')
            ->select('batch_id', DB::raw('count(*) as entered'))
            ->groupBy('batch_id')
            ->pluck('entered', 'batch_id');

        return $batches->map(function ($b) use ($counts) {
            $b->vehicles_entered = (int) ($counts[$b->id] ?? 0);

            return $b;
        });
    }

    public function findBatch(int $id): ?object
    {
        return DB::connection(self::CONNECTION)->table('batches')->where('id', $id)->first();
    }

    public function createBatch(array $data): int
    {
        $count = (int) ($data['cars_count'] ?? 0);
        $price = (float) ($data['unit_price'] ?? 0);

        return DB::connection(self::CONNECTION)->table('batches')->insertGetId([
            'car_type' => $data['car_type'] ?? null,
            'entry_date' => $data['entry_date'] ?? null,
            'cars_count' => $count,
            'unit_price' => $price,
            'total_amount' => $count * $price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateBatch(int $id, array $data): bool
    {
        $existing = $this->findBatch($id);
        if (! $existing) {
            return false;
        }

        $count = array_key_exists('cars_count', $data) ? (int) $data['cars_count'] : (int) $existing->cars_count;
        $price = array_key_exists('unit_price', $data) ? (float) $data['unit_price'] : (float) $existing->unit_price;

        $payload = ['updated_at' => now()];
        foreach (['car_type', 'entry_date'] as $field) {
            if (array_key_exists($field, $data)) {
                $payload[$field] = $data[$field];
            }
        }
        if (array_key_exists('cars_count', $data)) {
            $payload['cars_count'] = $count;
        }
        if (array_key_exists('unit_price', $data)) {
            $payload['unit_price'] = $price;
        }
        if (array_key_exists('cars_count', $data) || array_key_exists('unit_price', $data)) {
            $payload['total_amount'] = $count * $price;
        }

        return DB::connection(self::CONNECTION)->table('batches')->where('id', $id)->update($payload) >= 0;
    }

    public function deleteBatch(int $id): bool
    {
        DB::connection(self::CONNECTION)->table('vehicles')->where('batch_id', $id)->delete();

        return DB::connection(self::CONNECTION)->table('batches')->where('id', $id)->delete() > 0;
    }

    // ── Vehicles (السيارات الفردية / VIN) ──

    public function vehicles(int $batchId)
    {
        return DB::connection(self::CONNECTION)
            ->table('vehicles')
            ->where('batch_id', $batchId)
            ->orderBy('seq')
            ->orderBy('id')
            ->get();
    }

    public function findVehicle(int $id): ?object
    {
        return DB::connection(self::CONNECTION)->table('vehicles')->where('id', $id)->first();
    }

    public function createVehicle(int $batchId, array $data): int
    {
        $maxSeq = (int) DB::connection(self::CONNECTION)
            ->table('vehicles')
            ->where('batch_id', $batchId)
            ->max('seq');

        return DB::connection(self::CONNECTION)->table('vehicles')->insertGetId([
            'batch_id' => $batchId,
            'seq' => $maxSeq + 1,
            'model_name' => $data['model_name'] ?? null,
            'color' => $data['color'] ?? null,
            'model_year' => isset($data['model_year']) && $data['model_year'] !== '' && $data['model_year'] !== null
                ? (int) $data['model_year']
                : null,
            'vin' => isset($data['vin']) ? strtoupper(trim((string) $data['vin'])) : null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateVehicle(int $id, array $data): bool
    {
        if (! $this->findVehicle($id)) {
            return false;
        }

        $payload = ['updated_at' => now()];
        foreach (['model_name', 'color'] as $field) {
            if (array_key_exists($field, $data)) {
                $payload[$field] = $data[$field];
            }
        }
        if (array_key_exists('vin', $data)) {
            $payload['vin'] = strtoupper(trim((string) $data['vin']));
        }
        if (array_key_exists('model_year', $data)) {
            $payload['model_year'] = $data['model_year'] !== '' && $data['model_year'] !== null
                ? (int) $data['model_year']
                : null;
        }

        return DB::connection(self::CONNECTION)->table('vehicles')->where('id', $id)->update($payload) >= 0;
    }

    public function deleteVehicle(int $id): bool
    {
        return DB::connection(self::CONNECTION)->table('vehicles')->where('id', $id)->delete() > 0;
    }

    public function importVehicles(int $batchId, array $rows): int
    {
        $imported = 0;
        foreach ($rows as $row) {
            $vin = trim((string) ($row['vin'] ?? ''));
            if ($vin === '') {
                continue;
            }
            $this->createVehicle($batchId, [
                'model_name' => $row['model_name'] ?? null,
                'color' => $row['color'] ?? null,
                'model_year' => $row['model_year'] ?? null,
                'vin' => $vin,
            ]);
            $imported++;
        }

        return $imported;
    }

    // ── Remittances (الحوالات) ──

    public function remittances()
    {
        return DB::connection(self::CONNECTION)->table('remittances')->orderBy('id')->get();
    }

    public function findRemittance(int $id): ?object
    {
        return DB::connection(self::CONNECTION)->table('remittances')->where('id', $id)->first();
    }

    public function createRemittance(array $data): int
    {
        return DB::connection(self::CONNECTION)->table('remittances')->insertGetId([
            'amount' => (float) ($data['amount'] ?? 0),
            'transfer_date' => $data['transfer_date'] ?? null,
            'note' => $data['note'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function updateRemittance(int $id, array $data): bool
    {
        if (! $this->findRemittance($id)) {
            return false;
        }

        $payload = ['updated_at' => now()];
        if (array_key_exists('amount', $data)) {
            $payload['amount'] = (float) $data['amount'];
        }
        if (array_key_exists('transfer_date', $data)) {
            $payload['transfer_date'] = $data['transfer_date'];
        }
        if (array_key_exists('note', $data)) {
            $payload['note'] = $data['note'];
        }

        return DB::connection(self::CONNECTION)->table('remittances')->where('id', $id)->update($payload) >= 0;
    }

    public function deleteRemittance(int $id): bool
    {
        return DB::connection(self::CONNECTION)->table('remittances')->where('id', $id)->delete() > 0;
    }

    public function stats(): array
    {
        $batches = DB::connection(self::CONNECTION)
            ->table('batches')
            ->selectRaw('COALESCE(SUM(cars_count), 0) as cars_total')
            ->selectRaw('COALESCE(SUM(total_amount), 0) as amount_total')
            ->first();

        $transfers = DB::connection(self::CONNECTION)
            ->table('remittances')
            ->selectRaw('COALESCE(SUM(amount), 0) as transfer_total')
            ->first();

        $vehiclesEntered = (int) DB::connection(self::CONNECTION)->table('vehicles')->count();

        $carsTotal = (float) ($batches->cars_total ?? 0);
        $amountTotal = (float) ($batches->amount_total ?? 0);
        $transferTotal = (float) ($transfers->transfer_total ?? 0);

        return [
            'cars_total' => $carsTotal,
            'amount_total' => $amountTotal,
            'transfer_total' => $transferTotal,
            'vehicles_entered' => $vehiclesEntered,
            'remaining' => $amountTotal - $transferTotal,
            'balance_with_transfers' => $transferTotal - $amountTotal,
        ];
    }
}