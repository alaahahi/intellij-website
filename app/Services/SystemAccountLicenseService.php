<?php

namespace App\Services;

use Carbon\Carbon;
use InvalidArgumentException;

class SystemAccountLicenseService
{
    public function path(): string
    {
        $dir = database_path('system_accounts');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        return $dir.DIRECTORY_SEPARATOR.'license.json';
    }

    public function vendorName(): string
    {
        return 'التطبيق الذكي';
    }

    /**
     * @return array{vendor_name: string, activated_at: ?string, expires_at: ?string, days_granted: int, active: bool, days_left: int}
     */
    public function status(): array
    {
        $data = $this->read();
        $expiresAt = ! empty($data['expires_at']) ? Carbon::parse($data['expires_at'])->startOfDay() : null;
        $today = Carbon::today();
        $daysLeft = 0;

        if ($expiresAt && $expiresAt->gte($today)) {
            $daysLeft = (int) $today->diffInDays($expiresAt);
        }

        return [
            'vendor_name' => $data['vendor_name'] ?? $this->vendorName(),
            'activated_at' => $data['activated_at'] ?? null,
            'expires_at' => $data['expires_at'] ?? null,
            'days_granted' => (int) ($data['days_granted'] ?? 0),
            'active' => $daysLeft > 0,
            'days_left' => $daysLeft,
        ];
    }

    public function isActive(): bool
    {
        return $this->status()['active'] === true;
    }

    /**
     * Activate or extend license by $days (default 30).
     * If currently active: extend from expires_at.
     * If expired/missing: start from today.
     *
     * @return array{vendor_name: string, activated_at: ?string, expires_at: ?string, days_granted: int, active: bool, days_left: int}
     */
    public function activate(int $days = 30): array
    {
        if ($days < 1 || $days > 3650) {
            throw new InvalidArgumentException('عدد الأيام غير صالح.');
        }

        $current = $this->status();
        $today = Carbon::today();

        if ($current['active'] && ! empty($current['expires_at'])) {
            $base = Carbon::parse($current['expires_at'])->startOfDay();
        } else {
            $base = $today->copy();
        }

        $expires = $base->copy()->addDays($days);
        $payload = [
            'vendor_name' => $this->vendorName(),
            'activated_at' => $today->toDateString(),
            'expires_at' => $expires->toDateString(),
            'days_granted' => $days,
            'updated_at' => now()->toIso8601String(),
        ];

        $this->write($payload);

        return $this->status();
    }

    /**
     * @return array<string, mixed>
     */
    protected function read(): array
    {
        $path = $this->path();
        if (! is_file($path)) {
            return [
                'vendor_name' => $this->vendorName(),
                'activated_at' => null,
                'expires_at' => null,
                'days_granted' => 0,
            ];
        }

        $json = json_decode((string) file_get_contents($path), true);

        return is_array($json) ? $json : [
            'vendor_name' => $this->vendorName(),
            'activated_at' => null,
            'expires_at' => null,
            'days_granted' => 0,
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function write(array $data): void
    {
        file_put_contents(
            $this->path(),
            json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)
        );
    }
}
