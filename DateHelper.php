<?php

/**
 * Helper class for 'dates'
 *
 * PHP version 5.3+
 *
 * @version		1.0
 * @copyright 	Copyright (C) 2012 Stu Ellerbusch. All rights reserved.
 * @author    	Stu Ellerbusch
 * @link       	https://github.com/ellerbus/PHP-Date-Helper
 * @license    	http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * USE THIS LIBRARY AT YOUR OWN RISK: no warranties are expressed or
 * implied. You may modify the file however you see fit, so long as
 * you retain this header information and any credits to other sources
 * throughout the file.
 *
 *
 * Holiday Logic built from:
 * ========================================================================
 * US Holiday Calculations in PHP
 * Version 1.02
 * by Dan Kaplan <design@abledesign.com>
 * Last Modified: April 15, 2001
 * ------------------------------------------------------------------------
 * The holiday calculations on this page were assembled for
 * use in MyCalendar:  http://abledesign.com/programs/MyCalendar/
 *
 * USE THIS LIBRARY AT YOUR OWN RISK; no warranties are expressed or
 * implied. You may modify the file however you see fit, so long as
 * you retain this header information and any credits to other sources
 * throughout the file.  If you make any modifications or improvements,
 * please send them via email to Dan Kaplan <design@abledesign.com>.
 * ========================================================================
 */
final class DateHelper
{
    /**
     * YMD constant
     */
    const YMD = 'Y-m-d';
    /**
     * Format constant to create YMD when used in conjunciton with sprintf.
     * For example: sprintf('%04d-%02d-%02d', $y, $m, $d).
     */
    const Y04M02D02 = '%04d-%02d-%02d';

    /**
     * Gets 'now' as Y-m-d
     *
     * @return string date as Y-m-d
     */
    public static function getNow()
    {
        return date(self::YMD);
    }

    /**
     * Creates a date from year, month, day
     * @param int $year Four digit year (date('Y'))
     * @param int $month Month Number (date('n'))
     * @param int $day Day of Month (date('j'))
     * @return type
     */
    private static function getDate($year, $month, $day)
    {
        return date(self::YMD, mktime(0, 0, 0, $month, $day, $year));
    }

    /**
     * Common function to get 'time' from user input
     *
     * @param mixed $time (string or int)
     * @return int time in seconds
     */
    private static function getTime($time)
    {
        if (empty($time))
        {
            return time();
        }

        if (is_string($time))
        {
            return strtotime($time);
        }

        return $time;
    }

    /**
     * Gets the next date based on a frequency type
     *
     * @param string $frequency D,W,M,Q,Y
     * @return string date
     */
    public static function getNext($frequency)
    {
        switch ($frequency)
        {
            case'd':
            case'D':
                return self::getStartOfNextDay();
            case'w':
            case'W':
                return self::getStartOfNextWeek();
            case'm':
            case'M':
                return self::getStartOfNextMonth();
            case'q':
            case'Q':
                return self::getStartOfNextQuarter();
            case'y':
            case'Y':
                return self::getStartOfNextYear();
        }

        throw new Exception("Invalid Frequency Type: $frequency");
    }

    /**
     * Gets the start of the day
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfDay($time = null)
    {
        $time = self::getTime($time);

        $m = date('n', $time);
        $d = date('j', $time);
        $y = date('Y', $time);

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the day following now or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfNextDay($time = null)
    {
        $time = self::getTime($time);

        $time = strtotime('+1 day', $time);

        return self::getStartOfDay($time);
    }

    /**
     * Gets the start of the day previous to now or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfPrevDay($time = null)
    {
        $time = self::getTime($time);

        $time = strtotime('-1 day', $time);

        return self::getStartOfDay($time);
    }

    /**
     * Gets the start of the week based on now or supplied time (starts on SUN)
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfWeek($time = null)
    {
        $time = self::getTime($time);

        $w = date('w', $time);

        if ($w > 0)
        {
            $w -= 1;
        }

        $m = date('n', $time);
        $d = date('j', $time) - $w;
        $y = date('Y', $time);

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the follwing week based on now or supplied time (starts on SUN)
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfNextWeek($time = null)
    {
        $time = self::getTime($time);

        $time = strtotime('+7 days', $time);

        return self::getStartOfWeek($time);
    }

    /**
     * Gets the start of the previous week based on now or supplied time (starts on SUN)
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfPrevWeek($time = null)
    {
        $time = self::getTime($time);

        $time = strtotime('-7 days', $time);

        return self::getStartOfWeek($time);
    }

    /**
     * Gets the start of the month based on now or supplied time (the 1st)
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfMonth($time = null)
    {
        $time = self::getTime($time);

        $m = date('n', $time);
        $d = 1;
        $y = date('Y', $time);

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the following month based on now or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfNextMonth($time = null)
    {
        $time = self::getTime($time);

        $y = date('Y', $time);
        $m = date('m', $time) + 1;

        if ($m > 12)
        {
            $y += 1;
            $m = 1;
        }

        return self::getDate($y, $m, 1);
    }

    /**
     * Gets the start of the previous month based on now or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getStartOfPrevMonth($time = null)
    {
        $time = self::getTime($time);

        $y = date('Y', $time);
        $m = date('m', $time) - 1;

        if ($m == 0)
        {
            $y -= 1;
            $m = 12;
        }

        return self::getDate($y, $m, 1);
    }

    /**
     * Gets the end of the month based on now or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getEndOfMonth($time = null)
    {
        $time = self::getTime($time);

        $m = date('n', $time);
        $d = date('t', $time);
        $y = date('Y', $time);

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the quarter based on now or
     * supplied time
     *
     * @param mixed $time (string or int)
     * @return string date (1/1, 4/1, 7/1, 10/1)
     */
    public static function getStartOfQuarter($time = null)
    {
        $time = self::getTime($time);

        switch (self::getTheQuarter($time))
        {
            case 1:
                $month = 1;
                break;
            case 2:
                $month = 4;
                break;
            case 3:
                $month = 7;
                break;
            case 4:
                $month = 10;
                break;
            default:
                $month = 1;
                break;
        }

        $m = $month;
        $d = 1;
        $y = date('Y', $time);

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the follwing quarter based on now
     * or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date (1/1, 4/1, 7/1, 10/1)
     */
    public static function getStartOfNextQuarter($time = null)
    {
        $time = self::getTime($time);

        $time = self::getStartOfQuarter($time);

        $m = self::getTheQuarter() * 3 + 3;
        $d = 1;
        $y = date('Y', self::getTime($time));

        if ($m > 12)
        {
            $m = 1;
            $y += 1;
        }

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the previous quarter based on now
     * or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date (1/1, 4/1, 7/1, 10/1)
     */
    public static function getStartOfPrevQuarter($time = null)
    {
        $time = self::getTime($time);

        $time = self::getStartOfQuarter($time);

        $m = self::getTheQuarter() * 3 - 3;
        $d = 1;
        $y = date('Y', self::getTime($time));

        if ($m == 0)
        {
            $m = 10;
            $y -= 1;
        }

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the numeric expression of the current quarter 1-4
     *
     * @param mixed $time (string or int)
     * @return int the current quarter
     */
    public static function getTheQuarter($time = null)
    {
        $time = self::getTime($time);

        return ceil(date('m', $time) / 3);
    }

    /**
     * Gets the start of the year based on now
     * or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date (1/1)
     */
    public static function getStartOfYear($time = null)
    {
        $time = self::getTime($time);

        $m = 1;
        $d = 1;
        $y = date('Y', $time);

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the following year based on now
     * or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date (1/1)
     */
    public static function getStartOfNextYear($time = null)
    {
        $time = self::getTime($time);

        $m = 1;
        $d = 1;
        $y = date('Y', $time) + 1;

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets the start of the previous year based on now
     * or supplied time
     *
     * @param mixed $time (string or int)
     * @return string date (1/1)
     */
    public static function getStartOfPrevYear($time = null)
    {
        $time = self::getTime($time);

        $m = 1;
        $d = 1;
        $y = date('Y', $time) - 1;

        return self::getDate($y, $m, $d);
    }

    /**
     * Gets a date from the $time
     *
     * @param mixed $time (string or int)
     * @return string date
     */
    public static function getDateFromTime($time)
    {
        return date(self::YMD, $time);
    }

    /**
     * Gets the number of days between two dates
     *
     * @param mixed $start (string or int)
     * @param mixed $end (string or int)
     * @return int total number of days
     */
    public static function getDays($start, $end)
    {
        $start = self::getTime(self::getStartOfDay($start));

        $end = self::getTime(self::getStartOfDay($end));

        $diff = $end - $start;

        return round($diff / 86400);
    }

    /**
     * Gets the following business day based on now or supplied time
	 * (inclusive of '$time', starts with '$time')
     *
     * @param mixed $time (string or int)
     */
    public static function getNextBusinessDay($time = null)
    {
        $time = self::getTime($time);

        //  roll forward if a weekend or holiday
        $dt = date(self::YMD, $time);

        while (!self::isBusinessDay($dt))
        {
            $dt = self::getStartOfNextDay($dt);
        }

        return $dt;
    }

    /**
     * Gets the previous business day based on now or supplied time
	 * (exclusive of '$time', starts with 1 day previous to '$time')
     *
     * @param mixed $time (string or int)
     */
    public static function getPrevBusinessDay($time = null)
    {
        $time = self::getTime($time);

        //  roll forward if a weekend or holiday
        $dt = self::getStartOfPrevDay($time);

        while (!self::isBusinessDay($dt))
        {
            $dt = self::getStartOfPrevDay($dt);
        }

        return $dt;
    }

    /**
     * Gets the last business day of a month based on now or supplied time
     * (rolling backward if the end of month is a holiday or weekend)
     *
     * @param mixed $time (string or int)
     */
    public static function getLastBusinessDay($time = null)
    {
        $time = self::getTime($time);

        $time = self::getEndOfMonth($time);

        return self::getPrevBusinessDay($time);
    }

    /**
     * Determines if the given date is a business day
     *
     * @param mixed $time (string or int)
     * @return boolean true if valid business day, else false
     */
    public static function isBusinessDay($time)
    {
        $time = self::getTime($time);

        $dow = date('w', $time);

        if ($dow == 0 || $dow == 6)
        {
            //  sunday or saturday
            return false;
        }

        return !self::isHoliday($time);
    }

    /**
     * Determines if the given date is a holiday
     *
     * @param mixed $time (string or int)
     * @return boolean true if holiday, else false
     */
    public static function isHoliday($time = null)
    {
        $time = self::getTime($time);

        $time = self::getStartOfDay($time);

        list($year) = explode('-', $time);

        $holidays = self::getHolidays($year);

        if (in_array($time, $holidays))
        {
            return true;
        }

        return false;
    }

    /**
     * Gets a list of US holidays for a given year
     *
     * @param int $y year
     * @return array keys as holiday name, and values as Y-m-d
     */
    public static function getHolidays($y)
    {
        $holidays = array(
            'New Years Day' => sprintf(self::Y04M02D02, $y, 1, 1),
            'New Years Day Observed' => self::getObservedHoliday($y, 1, 1),
            'Martin Luther King Day Observed' => self::getHoliday($y, 1, 1, 3),
            //'Valentines Day' => sprintf(self::Y04M02D02, $y, 2, 14),
            'Presidents Day Observed' => self::getHoliday($y, 2, 1, 3),
            'St. Patricks Day' => sprintf(self::Y04M02D02, $y, 3, 17),
            'Easter' => self::getEaster($y),
            //'Cinco De Mayo = ". sprintf(self::Y04M02D02, $y, 5, 5),
            'Memorial Day Observed' => self::getHoliday($y, 5, 1),
            'Independence Day' => sprintf(self::Y04M02D02, $y, 7, 4),
            'Independence Day Observed' => self::getObservedHoliday($y, 7, 4),
            'Labor Day Observed' => self::getHoliday($y, 9, 1, 1),
            'Columbus Day Observed' => self::getHoliday($y, 10, 1, 2),
            //'Halloween = ". sprintf(self::Y04M02D02, $y, 10, 31),
            //// Veteran's Day Observed - November 11th ?
            'Thanksgiving' => self::getHoliday($y, 11, 4, 4),
            'Christmas Day' => sprintf(self::Y04M02D02, $y, 12, 25),
            'Christmas Day Observed' => self::getObservedHoliday($y, 12, 25)
        );

        $good_friday = strtotime($holidays['Easter']);

        while (date('w', $good_friday) != 5)
        {
            $good_friday = strtotime('-1 days', $good_friday);
        }

        $holidays['Good Friday'] = date(self::YMD, $good_friday);

        return $holidays;
    }

    /**
     * The following function get_holiday() is based on the work done by
     * Marcos J. Montes: http://www.smart.net/~mmontes/ushols.html
     * if $week is not passed in, then we are checking for the last week of the month
     *
     * @param type $year
     * @param type $month
     * @param type $day_of_week
     * @param type $week
     * @return boolean
     */
    private static function getHoliday($year, $month, $day_of_week, $week = "")
    {
        $invalid_week = ($week != "" && ($week > 5 || $week < 1));
        $invalid_day_of_week = ($day_of_week > 6 || $day_of_week < 0);

        if ($invalid_week || $invalid_day_of_week)
        {
            // $day_of_week must be between 0 and 6 (Sun=0, ... Sat=6); $week must be between 1 and 5
            return FALSE;
        }
        else
        {
            if (!$week || ($week == ""))
            {
                $t1 = mktime(0, 0, 0, $month, 1, $year);

                $lastday = date("t", $t1);

                $t2 = mktime(0, 0, 0, $month, $lastday, $year);

                $temp = (date("w", $t2) - $day_of_week) % 7;
            }
            else
            {
                $t1 = mktime(0, 0, 0, $month, 1, $year);

                $temp = ($day_of_week - date("w", $t1)) % 7;
            }

            if ($temp < 0)
            {
                $temp += 7;
            }

            if (!$week || ($week == ""))
            {
                $day = $lastday - $temp;
            }
            else
            {
                $day = (7 * $week) - 6 + $temp;
            }

            return self::getDate($year, $month, $day);
        }
    }

    /**
     * The day that the given holiday is obeserved
     *
     * @param int $year
     * @param int $month
     * @param int $day
     * @return type
     */
    private static function getObservedHoliday($year, $month, $day)
    {
        $tm = mktime(0, 0, 0, $month, $day, $year);

        // sat -> fri & sun -> mon, any exceptions?
        //
        // should check $lastday for bumping forward and $firstday for bumping back,
        // although New Year's & Easter look to be the only holidays that potentially
        // move to a different month, and both are accounted for.

        $dow = date('w', $tm);

        if ($dow == 0)
        {
            $dow = $day + 1;
        }
        elseif ($dow == 6)
        {
            if ($month == 1 && $day == 1)
            {
                // New Year's on a Saturday
                $year--;
                $month = 12;
                $dow = 31;
            }
            else
            {
                $dow = $day - 1;
            }
        }
        else
        {
            $dow = $day;
        }

        return self::getDate($year, $month, $dow);
    }

    /**
     *
     * @param int $y
     * @return type
     */
    private static function getEaster($y)
    {
        // In the text below, 'intval($var1/$var2)' represents an integer division neglecting
        // the remainder, while % is division keeping only the remainder. So 30/7=4, and 30%7=2
        //
        // This algorithm is from Practical Astronomy With Your Calculator, 2nd Edition by Peter
        // Duffett-Smith. It was originally from Butcher's Ecclesiastical Calendar, published in
        // 1876. This algorithm has also been published in the 1922 book General Astronomy by
        // Spencer Jones; in The Journal of the British Astronomical Association (Vol.88, page
        // 91, December 1977); and in Astronomical Algorithms (1991) by Jean Meeus.

        $a = $y % 19;
        $b = intval($y / 100);
        $c = $y % 100;
        $d = intval($b / 4);
        $e = $b % 4;
        $f = intval(($b + 8) / 25);
        $g = intval(($b - $f + 1) / 3);
        $h = (19 * $a + $b - $d - $g + 15) % 30;
        $i = intval($c / 4);
        $k = $c % 4;
        $l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
        $m = intval(($a + 11 * $h + 22 * $l) / 451);
        $p = ($h + $l - 7 * $m + 114) % 31;
        $easter_month = intval(($h + $l - 7 * $m + 114) / 31);    // [3 = March, 4 = April]
        $easter_day = $p + 1;    // (day in Easter Month)

        return self::getDate($y, $easter_month, $easter_day);
    }

}
