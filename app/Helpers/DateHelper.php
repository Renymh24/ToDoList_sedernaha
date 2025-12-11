<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format a date (string, DateTime or Carbon) into the given format.
     *
     * @param  mixed  $date
     * @param  string $format
     * @return string|null
     */
    public static function formatDate($date, string $format = 'M d Y'): ?string
    {
        if (is_null($date) || $date === '') {
            return null;
        }

        try {
            $dt = $date instanceof Carbon ? $date : Carbon::parse($date);
            return $dt->format($format);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Return a human readable diff (e.g., "2 hours ago").
     *
     * @param mixed $date
     * @return string|null
     */
    public static function humanDiff($date): ?string
    {
        if (is_null($date) || $date === '') {
            return null;
        }

        try {
            $dt = $date instanceof Carbon ? $date : Carbon::parse($date);
            return $dt->diffForHumans();
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Convert a date to ISO 8601 (Y-m-d H:i:s) string.
     *
     * @param mixed $date
     * @return string|null
     */
    public static function toIso($date): ?string
    {
        if (is_null($date) || $date === '') {
            return null;
        }

        try {
            $dt = $date instanceof Carbon ? $date : Carbon::parse($date);
            return $dt->toDateTimeString();
        } catch (\Throwable $e) {
            return null;
        }
    }
}
