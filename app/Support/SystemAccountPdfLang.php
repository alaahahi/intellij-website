<?php

namespace App\Support;

class SystemAccountPdfLang
{
    public const LOCALES = ['ar', 'en', 'ckb'];

    private const STRINGS = [
        'ar' => [
            'title' => 'كشف حساب',
            'subtitle' => 'كشف حساب — السيارات والحوالات والتقاص',
            'print' => 'طباعة / PDF',
            'back' => 'العودة للنظام',
            'date' => 'التاريخ',
            'cars_count' => 'عدد السيارات',
            'remittances_count' => 'عدد الحوالات',
            'cars' => 'السيارات',
            'cars_rows' => ':count سطر · مجموع :total',
            'no_cars' => 'لا توجد سيارات',
            'col_num' => '#',
            'col_car_type' => 'نوع السيارة',
            'col_date' => 'التاريخ',
            'col_count' => 'العدد',
            'col_unit_price' => 'سعر الوحدة',
            'col_total' => 'المجموع',
            'total' => 'الإجمالي',
            'settlement' => 'التقاص',
            'cars_total' => 'مجموع السيارات',
            'transfers_total' => 'مجموع الحوالات',
            'remaining' => 'المتبقي (سيارات − حوالات)',
            'remittances' => 'الحوالات',
            'rem_rows' => ':count حوالة · مجموع :total',
            'no_remittances' => 'لا توجد حوالات',
            'col_amount' => 'المبلغ',
            'col_transfer_date' => 'تاريخ الحوالة',
            'col_note' => 'الملاحظة',
            'system' => 'نظام الحساب',
            'vendor' => 'التطبيق الذكي',
            'dir' => 'rtl',
            'html_lang' => 'ar',
        ],
        'en' => [
            'title' => 'Account statement',
            'subtitle' => 'Account statement — cars, remittances and settlement',
            'print' => 'Print / PDF',
            'back' => 'Back to system',
            'date' => 'Date',
            'cars_count' => 'Cars count',
            'remittances_count' => 'Remittances count',
            'cars' => 'Cars',
            'cars_rows' => ':count rows · total :total',
            'no_cars' => 'No cars yet',
            'col_num' => '#',
            'col_car_type' => 'Car type',
            'col_date' => 'Date',
            'col_count' => 'Count',
            'col_unit_price' => 'Unit price',
            'col_total' => 'Total',
            'total' => 'Total',
            'settlement' => 'Settlement',
            'cars_total' => 'Cars total',
            'transfers_total' => 'Remittances total',
            'remaining' => 'Remaining (cars − remittances)',
            'remittances' => 'Remittances',
            'rem_rows' => ':count remittances · total :total',
            'no_remittances' => 'No remittances',
            'col_amount' => 'Amount',
            'col_transfer_date' => 'Transfer date',
            'col_note' => 'Note',
            'system' => 'Account system',
            'vendor' => 'Smart App',
            'dir' => 'ltr',
            'html_lang' => 'en',
        ],
        'ckb' => [
            'title' => 'ڕاپۆرتی حساب',
            'subtitle' => 'ڕاپۆرتی حساب — ئۆتۆمبێل، حوالە و یەکسانکردن',
            'print' => 'چاپ / PDF',
            'back' => 'گەڕانەوە بۆ سیستەم',
            'date' => 'بەروار',
            'cars_count' => 'ژمارەی ئۆتۆمبێل',
            'remittances_count' => 'ژمارەی حوالە',
            'cars' => 'ئۆتۆمبێلەکان',
            'cars_rows' => ':count هێڵ · کۆی :total',
            'no_cars' => 'هیچ ئۆتۆمبێلێک نییە',
            'col_num' => '#',
            'col_car_type' => 'جۆری ئۆتۆمبێل',
            'col_date' => 'بەروار',
            'col_count' => 'ژمارە',
            'col_unit_price' => 'نرخی یەکە',
            'col_total' => 'کۆی گشتی',
            'total' => 'کۆی گشتی',
            'settlement' => 'یەکسانکردن',
            'cars_total' => 'کۆی ئۆتۆمبێلەکان',
            'transfers_total' => 'کۆی حوالەکان',
            'remaining' => 'ماوە (ئۆتۆمبێل − حوالە)',
            'remittances' => 'حوالەکان',
            'rem_rows' => ':count حوالە · کۆی :total',
            'no_remittances' => 'هیچ حوالەیەک نییە',
            'col_amount' => 'بڕ',
            'col_transfer_date' => 'بەرواری حوالە',
            'col_note' => 'تێبینی',
            'system' => 'سیستەمی حساب',
            'vendor' => 'ئەپڵیکەیشنی زیریرەک',
            'dir' => 'rtl',
            'html_lang' => 'ckb',
        ],
    ];

    public static function resolve(?string $locale): string
    {
        $locale = strtolower(trim((string) $locale));

        return in_array($locale, self::LOCALES, true) ? $locale : 'ar';
    }

    public static function all(string $locale): array
    {
        $locale = self::resolve($locale);

        return self::STRINGS[$locale];
    }

    public static function get(string $locale, string $key, array $replace = []): string
    {
        $strings = self::all($locale);
        $text = $strings[$key] ?? self::STRINGS['ar'][$key] ?? $key;

        foreach ($replace as $search => $value) {
            $text = str_replace(':'.$search, (string) $value, $text);
        }

        return $text;
    }
}
