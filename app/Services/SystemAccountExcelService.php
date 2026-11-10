<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
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

    public function import(UploadedFile $file): int
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $imported = 0;

        $highestRow = $sheet->getHighestDataRow();

        for ($row = 9; $row <= $highestRow; $row++) {
            $carType = $this->cellString($sheet->getCell('B'.$row)->getValue());
            $entryDate = $this->normalizeDate($sheet->getCell('C'.$row)->getCalculatedValue());
            $carsCount = (int) $sheet->getCell('D'.$row)->getCalculatedValue();
            $unitPrice = (float) $sheet->getCell('E'.$row)->getCalculatedValue();
            $transferAmountRaw = $sheet->getCell('G'.$row)->getCalculatedValue();
            $transferDate = $this->normalizeDate($sheet->getCell('H'.$row)->getCalculatedValue());
            $transferNote = $this->cellString($sheet->getCell('I'.$row)->getValue());

            if ($carType === null && $carsCount === 0 && $unitPrice == 0.0 && ($transferAmountRaw === null || $transferAmountRaw === '')) {
                continue;
            }

            if ($carType === null && $carsCount === 0) {
                continue;
            }

            $this->accounts->createCar([
                'car_type' => $carType,
                'entry_date' => $entryDate,
                'cars_count' => $carsCount,
                'unit_price' => $unitPrice,
                'transfer_amount' => ($transferAmountRaw === null || $transferAmountRaw === '') ? null : (float) $transferAmountRaw,
                'transfer_date' => $transferDate,
                'transfer_note' => $transferNote,
            ]);

            $imported++;
        }

        return $imported;
    }

    public function export(string $companyName): StreamedResponse
    {
        $cars = $this->accounts->cars();
        $lastDataRow = 8 + max($cars->count(), 62);

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
        $sheet->setCellValue('I5', 'المجموع الحوالات');

        $sheet->setCellValue('A7', 'مجموع السيارات');
        $sheet->setCellValue('D7', '=SUM(D9:D'.$lastDataRow.')');

        $headers = ['*', 'نوع السيارة', 'التاريخ', 'عدد السيارات', 'سعرالسيارات $', 'المجموع الكلي', 'مبلغ الحوالات', 'تاريخ الحوالة', ' الحوالة'];
        $cols = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];
        foreach ($headers as $i => $header) {
            $sheet->setCellValue($cols[$i].'8', $header);
        }

        $row = 9;
        foreach ($cars as $index => $car) {
            $sheet->setCellValue('A'.$row, $index + 1);
            $sheet->setCellValue('B'.$row, $car->car_type);
            $sheet->setCellValueExplicit('C'.$row, (string) ($car->entry_date ?? ''), DataType::TYPE_STRING);
            $sheet->setCellValue('D'.$row, (int) $car->cars_count);
            $sheet->setCellValue('E'.$row, (float) $car->unit_price);
            $sheet->setCellValue('F'.$row, '=E'.$row.'*D'.$row);

            if ($car->transfer_amount !== null) {
                $sheet->setCellValue('G'.$row, (float) $car->transfer_amount);
            }

            if ($car->transfer_date) {
                $sheet->setCellValueExplicit('H'.$row, (string) $car->transfer_date, DataType::TYPE_STRING);
            }

            if ($car->transfer_note) {
                $sheet->setCellValue('I'.$row, $car->transfer_note);
            }

            $row++;
        }

        // Keep empty formula rows like the original file
        $emptyUntil = max($lastDataRow, $row + 10);
        for ($r = $row; $r <= $emptyUntil; $r++) {
            $sheet->setCellValue('A'.$r, $r - 8);
            $sheet->setCellValue('F'.$r, '=E'.$r.'*D'.$r);
        }

        $filename = 'account-'.str_replace(' ', '-', $companyName).'.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function importFromPath(string $path): int
    {
        if (! is_file($path)) {
            return 0;
        }

        $spreadsheet = IOFactory::load($path);
        $sheet = $spreadsheet->getActiveSheet();
        $imported = 0;
        $highestRow = $sheet->getHighestDataRow();

        // Clear existing rows before seed import
        DB::connection(SystemAccountService::CONNECTION)->table('car_entries')->delete();

        for ($row = 9; $row <= $highestRow; $row++) {
            $carType = $this->cellString($sheet->getCell('B'.$row)->getValue());
            $entryDate = $this->normalizeDate($sheet->getCell('C'.$row)->getCalculatedValue());
            $carsCount = (int) $sheet->getCell('D'.$row)->getCalculatedValue();
            $unitPrice = (float) $sheet->getCell('E'.$row)->getCalculatedValue();
            $transferAmountRaw = $sheet->getCell('G'.$row)->getCalculatedValue();
            $transferDate = $this->normalizeDate($sheet->getCell('H'.$row)->getCalculatedValue());
            $transferNote = $this->cellString($sheet->getCell('I'.$row)->getValue());

            if ($carType === null || $carsCount === 0) {
                continue;
            }

            $this->accounts->createCar([
                'car_type' => $carType,
                'entry_date' => $entryDate,
                'cars_count' => $carsCount,
                'unit_price' => $unitPrice,
                'transfer_amount' => ($transferAmountRaw === null || $transferAmountRaw === '') ? null : (float) $transferAmountRaw,
                'transfer_date' => $transferDate,
                'transfer_note' => $transferNote,
            ]);

            $imported++;
        }

        return $imported;
    }

    private function cellString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private function normalizeDate(mixed $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof \DateTimeInterface) {
            return $value->format('d/m/Y');
        }

        if (is_numeric($value)) {
            try {
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float) $value);

                return $date->format('d/m/Y');
            } catch (\Throwable) {
                return (string) $value;
            }
        }

        return trim((string) $value);
    }
}
