<?php

use App\Helpers\DateHelper;

if (! function_exists('format_date')) {
    /**
     * Shortcut to format a date using DateHelper::formatDate
     *
     * @param mixed $date
     * @param string $format
     * @return string|null
     */
    function format_date($date, string $format = 'M d Y')
    {
        return DateHelper::formatDate($date, $format);
    }
}

if (! function_exists('date_diff_human')) {
    /**
     * Shortcut to get human readable diff
     *
     * @param mixed $date
     * @return string|null
     */
    function date_diff_human($date)
    {
        return DateHelper::humanDiff($date);
    }
}
