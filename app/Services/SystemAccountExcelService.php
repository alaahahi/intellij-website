<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SystemAccountExcelService
{
    public function __construct(private SystemAccountService $accounts)
    {
    }

    /**
     * Import VIN list like kawa vins.xlsx:
     * A=seq, B=model, C=?, D=VIN  (or A=model, B=VIN)
     */
    public function importVehicles(UploadedFile $file, int $batchId): int
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $highestRow = $sheet->getHighestDataRow();
        $rows = [];

        for ($row = 1; $row <= $highestRow; $row++) {
            $a = $this->cellString($sheet->getCell('A'.$row)->getValue());
            $b = $this->cellString($sheet->getCell('B'.$row)->getValue());
            $c = $this->cellString($sheet->getCell('C'.$row)->getValue());
            $d = $this->cellString($sheet->getCell('D'.$row)->getValue());

            $vin = null;
            $model = null;

            // Format: seq | model | empty | VIN
            if ($d && $this->looksLikeVin($d)) {
                $vin = $d;
                $model = $b;
            } elseif ($b && $this->looksLikeVin($b) && ! $this->looksLikeVin((string) $a)) {
                $vin = $b;
                $model = is_numeric($a) ? null : $a;
            } elseif ($c && $this->looksLikeVin($c)) {
                $vin = $c;
                $model = $b ?: $a;
            } elseif ($a && $this->looksLikeVin($a)) {
                $vin = $a;
                $model = $b;
            }

            if (! $vin) {
                continue;
            }

            $rows[] = [
                'model_name' => $model,
                'vin' => strtoupper($vin),
            ];
        }

        return $this->accounts->importVehicles($batchId, $rows);
    }

    public function export(string $companyName): StreamedResponse
    {
        $batches = $this->accounts->batches();
        $remittances = $this->accounts->remittances();
        $lastDataRow = 8 + max($batches->count(), 62);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Sheet1');

        $sheet->setCellValue('A1', 'حساب '.$companyName);
        $sheet->setCellValue('A3', 'المجموع الكلي بالحوالات');
        $sheet->setCellValue('F3', '=G5-F5');
        $sheet->setCellValue('I3', 'NO :1');
        $sheet->setCellValue('A5', 'المجموع الكلي بدون حوالات');
        $sheet->setCellValue('F5', '=SUM(F9:F'.$lastDataRow.')');
        $sheet->setCellValue('G5', '=SUM(G9:G'.$lastDataRow.')');
        $sheet->setCellValue('H5', 'المجموع الحوالات');
        $sheet->setCellValue('A7', 'مجموع السيارات');
        $sheet->setCellValue('D7', '=SUM(D9:D'.$lastDataRow.')');

        $headers = ['*', 'نوع السيارة', 'التاريخ', 'عدد السيارات', 'سعرالسيارات $', 'المجموع الكلي', 'مبلغ الحوالات', 'تاريخ الحوالة', ' الحوالة'];
        foreach (['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'] as $i => $col) {
            $sheet->setCellValue($col.'8', $headers[$i]);
        }

        $row = 9;
        foreach ($batches as $index => $batch) {
            $sheet->setCellValue('A'.$row, $index + 1);
            $sheet->setCellValue('B'.$row, $batch->car_type);
            $sheet->setCellValueExplicit('C'.$row, (string) ($batch->entry_date ?? ''), DataType::TYPE_STRING);
            $sheet->setCellValue('D'.$row, (int) $batch->cars_count);
            $sheet->setCellValue('E'.$row, (float) $batch->unit_price);
            $sheet->setCellValue('F'.$row, '=E'.$row.'*D'.$row);
            $row++;
        }

        // Put remittances starting at G9 downwards (account-level, not per batch)
        $rRow = 9;
        foreach ($remittances as $rem) {
            $sheet->setCellValue('G'.$rRow, (float) $rem->amount);
            if ($rem->transfer_date) {
                $sheet->setCellValueExplicit('H'.$rRow, (string) $rem->transfer_date, DataType::TYPE_STRING);
            }
            if ($rem->note) {
                $sheet->setCellValue('I'.$rRow, $rem->note);
            }
            $rRow++;
        }

        $emptyUntil = max($lastDataRow, $row + 10);
        for ($r = $row; $r <= $emptyUntil; $r++) {
            $sheet->setCellValue('A'.$r, $r - 8);
            $sheet->setCellValue('F'.$r, '=E'.$r.'*D'.$r);
        }

        $filename = 'account-'.str_replace(' ', '-', $companyName).'.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            (new Xlsx($spreadsheet))->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    private function looksLikeVin(string $value): bool
    {
        $v = strtoupper(preg_replace('/\s+/', '', $value));

        return (bool) preg_match('/^[A-HJ-NPR-Z0-9]{11,17}$/', $v);
    }

    private function cellString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }
}