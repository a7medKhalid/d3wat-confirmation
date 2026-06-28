<?php

namespace App\Services;

class KsaPhoneNormalizer
{
    public function normalize(?string $raw): array
    {
        $digits = $this->digitText($raw);

        if ($digits === '') {
            return ['', 'رقم الجوال فارغ'];
        }

        if (str_starts_with($digits, '00966')) {
            $digits = '966'.substr($digits, 5);
        }

        if (str_starts_with($digits, '96605') && strlen($digits) === 13) {
            $digits = '966'.substr($digits, 4);
        } elseif (str_starts_with($digits, '05') && strlen($digits) === 10) {
            $digits = '966'.substr($digits, 1);
        } elseif (str_starts_with($digits, '5') && strlen($digits) === 9) {
            $digits = '966'.$digits;
        }

        if (preg_match('/^9665\d{8}$/', $digits)) {
            return [$digits, ''];
        }

        return ['', 'رقم الجوال غير صالح'];
    }

    private function digitText(?string $raw): string
    {
        $text = trim((string) $raw);
        $text = strtr($text, [
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
        ]);

        $text = preg_replace('/(?<=\d)\.0+$/', '', $text) ?? $text;

        if (stripos($text, 'e') !== false) {
            $scientific = preg_replace('/[^\dEe+.-]/', '', $text);
            if (is_numeric($scientific)) {
                $text = (string) (int) (float) $scientific;
            }
        }

        return preg_replace('/\D+/', '', $text) ?? '';
    }
}
