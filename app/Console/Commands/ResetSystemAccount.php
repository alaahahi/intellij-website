<?php

namespace App\Console\Commands;

use App\Services\SystemAccountService;
use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ResetSystemAccount extends Command
{
    protected $signature = 'system-account:reset
                            {slug=burj-al-khur}
                            {--name=شركة برج الخور}
                            {--pin=123456}
                            {--excel= : Optional Excel path to seed batches/remittances}';

    protected $description = 'Recreate a system account SQLite DB with the new schema';

    public function handle(SystemAccountService $accounts): int
    {
        $slug = $this->argument('slug');
        $name = (string) $this->option('name');
        $pin = (string) $this->option('pin');
        $excel = $this->option('excel');

        $accounts->recreateFresh($slug, $name, $pin);
        $this->info("Recreated [{$slug}] PIN={$pin}");

        if ($excel && is_file($excel)) {
            $accounts->connect($slug);
            $imported = $this->seedFromExcel($accounts, $excel);
            $this->info("Seeded batches={$imported['batches']} remittances={$imported['remittances']}");
        }

        return self::SUCCESS;
    }

    protected function seedFromExcel(SystemAccountService $accounts, string $path): array
    {
        $sheet = IOFactory::load($path)->getActiveSheet();
        $highest = $sheet->getHighestDataRow();
        $batches = 0;
        $remittances = 0;

        for ($row = 9; $row <= $highest; $row++) {
            $type = trim((string) $sheet->getCell('B'.$row)->getValue());
            $count = (int) $sheet->getCell('D'.$row)->getCalculatedValue();
            $price = (float) $sheet->getCell('E'.$row)->getCalculatedValue();
            if ($type === '' || $count === 0) {
                continue;
            }

            $dateVal = $sheet->getCell('C'.$row)->getCalculatedValue();
            $entryDate = $dateVal instanceof \DateTimeInterface
                ? $dateVal->format('d/m/Y')
                : (is_numeric($dateVal)
                    ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $dateVal)->format('d/m/Y')
                    : (string) $dateVal);

            $accounts->createBatch([
                'car_type' => $type,
                'entry_date' => $entryDate ?: null,
                'cars_count' => $count,
                'unit_price' => $price,
            ]);
            $batches++;

            $transfer = $sheet->getCell('G'.$row)->getCalculatedValue();
            if ($transfer !== null && $transfer !== '' && (float) $transfer != 0.0) {
                $tDate = $sheet->getCell('H'.$row)->getCalculatedValue();
                $transferDate = $tDate instanceof \DateTimeInterface
                    ? $tDate->format('d/m/Y')
                    : (is_numeric($tDate)
                        ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $tDate)->format('d/m/Y')
                        : (string) $tDate);
                $accounts->createRemittance([
                    'amount' => (float) $transfer,
                    'transfer_date' => $transferDate ?: null,
                    'note' => trim((string) $sheet->getCell('I'.$row)->getValue()) ?: null,
                ]);
                $remittances++;
            }
        }

        return compact('batches', 'remittances');
    }
}