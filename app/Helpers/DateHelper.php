<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format tanggal ke format Indonesia yang mudah dibaca
     * Contoh: 15 Januari 2025
     * 
     * @param string|null $date
     * @return string
     */
    public static function formatIndonesian($date)
    {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM YYYY');
    }

    /**
     * Format tanggal dengan waktu
     * Contoh: 15 Januari 2025, 14:30
     * 
     * @param string|null $date
     * @return string
     */
    public static function formatWithTime($date)
    {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)->locale('id')->isoFormat('D MMMM YYYY, HH:mm');
    }

    /**
     * Format tanggal relatif (berapa hari lagi/yang lalu)
     * Contoh: 3 hari lagi, 2 hari yang lalu
     * 
     * @param string|null $date
     * @return string
     */
    public static function formatRelative($date)
    {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)->locale('id')->diffForHumans();
    }

    /**
     * Cek apakah tanggal sudah lewat
     * 
     * @param string|null $date
     * @return bool
     */
    public static function isPast($date)
    {
        if (!$date) {
            return false;
        }

        return Carbon::parse($date)->isPast();
    }

    /**
     * Cek apakah tanggal adalah hari ini
     * 
     * @param string|null $date
     * @return bool
     */
    public static function isToday($date)
    {
        if (!$date) {
            return false;
        }

        return Carbon::parse($date)->isToday();
    }

    /**
     * Cek apakah tanggal adalah besok
     * 
     * @param string|null $date
     * @return bool
     */
    public static function isTomorrow($date)
    {
        if (!$date) {
            return false;
        }

        return Carbon::parse($date)->isTomorrow();
    }

    /**
     * Hitung sisa hari dari sekarang
     * 
     * @param string|null $date
     * @return int
     */
    public static function daysUntil($date)
    {
        if (!$date) {
            return 0;
        }

        $target = Carbon::parse($date)->startOfDay();
        $now = Carbon::now()->startOfDay();

        return (int) $now->diffInDays($target, false);
    }

    /**
     * Format deadline dengan badge warna
     * Contoh: 'Hari ini' (merah), '3 hari lagi' (kuning), '1 minggu lagi' (hijau)
     * 
     * @param string|null $date
     * @return array ['text' => string, 'color' => string]
     */
    public static function formatDeadlineWithColor($date)
    {
        if (!$date) {
            return [
                'text' => 'Tidak ada deadline',
                'color' => 'gray'
            ];
        }

        $days = self::daysUntil($date);

        if ($days < 0) {
            $absDays = abs($days);
            return [
                'text' => $absDays . ' hari terlambat',
                'color' => 'red'
            ];
        }

        if ($days == 0) {
            return [
                'text' => 'Hari ini',
                'color' => 'red'
            ];
        }

        if ($days == 1) {
            return [
                'text' => 'Besok',
                'color' => 'orange'
            ];
        }

        if ($days <= 3) {
            return [
                'text' => $days . ' hari lagi',
                'color' => 'yellow'
            ];
        }

        if ($days <= 7) {
            return [
                'text' => $days . ' hari lagi',
                'color' => 'blue'
            ];
        }

        return [
            'text' => self::formatIndonesian($date),
            'color' => 'green'
        ];
    }

    /**
     * Format untuk input date HTML5
     * Contoh: 2025-01-15
     * 
     * @param string|null $date
     * @return string
     */
    public static function formatForInput($date)
    {
        if (!$date) {
            return '';
        }

        return Carbon::parse($date)->format('Y-m-d');
    }

    /**
     * Format tanggal pendek
     * Contoh: 15 Jan 2025
     * 
     * @param string|null $date
     * @return string
     */
    public static function formatShort($date)
    {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)->locale('id')->isoFormat('D MMM YYYY');
    }
}
