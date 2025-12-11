<?php

use App\Helpers\DateHelper;

if (!function_exists('formatDate')) {
    /**
     * Format tanggal ke format Indonesia
     */
    function formatDate($date)
    {
        return DateHelper::formatIndonesian($date);
    }
}

if (!function_exists('formatDateTime')) {
    /**
     * Format tanggal dengan waktu
     */
    function formatDateTime($date)
    {
        return DateHelper::formatWithTime($date);
    }
}

if (!function_exists('formatDateRelative')) {
    /**
     * Format tanggal relatif
     */
    function formatDateRelative($date)
    {
        return DateHelper::formatRelative($date);
    }
}

if (!function_exists('formatDateShort')) {
    /**
     * Format tanggal pendek
     */
    function formatDateShort($date)
    {
        return DateHelper::formatShort($date);
    }
}

if (!function_exists('formatDeadline')) {
    /**
     * Format deadline dengan badge warna
     */
    function formatDeadline($date)
    {
        return DateHelper::formatDeadlineWithColor($date);
    }
}

if (!function_exists('formatDateInput')) {
    /**
     * Format untuk input date HTML5
     */
    function formatDateInput($date)
    {
        return DateHelper::formatForInput($date);
    }
}

if (!function_exists('isPastDate')) {
    /**
     * Cek apakah tanggal sudah lewat
     */
    function isPastDate($date)
    {
        return DateHelper::isPast($date);
    }
}

if (!function_exists('isToday')) {
    /**
     * Cek apakah tanggal adalah hari ini
     */
    function isToday($date)
    {
        return DateHelper::isToday($date);
    }
}

if (!function_exists('isTomorrow')) {
    /**
     * Cek apakah tanggal adalah besok
     */
    function isTomorrow($date)
    {
        return DateHelper::isTomorrow($date);
    }
}
