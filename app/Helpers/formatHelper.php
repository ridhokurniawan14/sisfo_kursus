<?php

if (!function_exists('formatNoRek')) {
    function formatNoRek($noRek)
    {
        return implode('-', str_split($noRek, 4));
    }
}
if (!function_exists('terbilang')) {
    function terbilang($nilai)
    {
        $satuan = ['Nol', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan'];

        if ($nilai < 10) {
            return $satuan[$nilai];
        } elseif ($nilai < 100) {
            $digit_pertama = floor($nilai / 10);
            $digit_kedua = $nilai % 10;
            return trim($satuan[$digit_pertama] . ' ' . $satuan[$digit_kedua]);
        } else {
            return 'Nilai tidak valid';
        }
    }
}
