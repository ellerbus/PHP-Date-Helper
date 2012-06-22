<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . 'DateHelper.php';

$dt = isset($_GET['date']) ? $_GET['date'] : date(DateHelper::YMD);


$n = DateHelper::getStartOfNextDay($dt);
$p = DateHelper::getStartOfPrevDay($dt);

echo '<html><body>';
echo '<div>As of ', $dt, '</div>';
echo '<table>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Day: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Now</td><td>', DateHelper::getNow(), '</td></tr>';
echo '<tr><td>Start of Day</td><td>', DateHelper::getStartOfDay($dt), '</td></tr>';
echo '<tr><td>Next Day</td><td>', $n;
echo '<tr><td>Prev Day</td><td>', $p;
echo '<tr><td>Days between Prev/Next</td><td>', DateHelper::getDays($p, $n), '</td></tr>';
echo '<tr><td>Next Business Day</td><td>', DateHelper::getNextBusinessDay($dt), '</td></tr>';
echo '<tr><td>Prev Business Day</td><td>', DateHelper::getPrevBusinessDay($dt), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Week: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Week</td><td>', DateHelper::getStartOfWeek($dt), '</td></tr>';
echo '<tr><td>Next Week</td><td>', DateHelper::getStartOfNextWeek($dt), '</td></tr>';
echo '<tr><td>Prev Week</td><td>', DateHelper::getStartOfPrevWeek($dt), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Month: START/END/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Month</td><td>', DateHelper::getStartOfMonth($dt), '</td></tr>';
echo '<tr><td>End of Month</td><td>', DateHelper::getEndOfMonth($dt), '</td></tr>';
echo '<tr><td>Next Month</td><td>', DateHelper::getStartOfNextMonth($dt), '</td></tr>';
echo '<tr><td>Prev Month</td><td>', DateHelper::getStartOfPrevMonth($dt), '</td></tr>';
echo '<tr><td>Last Business Day in Month</td><td>', DateHelper::getLastBusinessDay($dt), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Quarter: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Quarter</td><td>', DateHelper::getStartOfQuarter($dt), '</td></tr>';
echo '<tr><td>Next Quarter</td><td>', DateHelper::getStartOfNextQuarter($dt), '</td></tr>';
echo '<tr><td>Prev Quarter</td><td>', DateHelper::getStartOfPrevQuarter($dt), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Year: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Year</td><td>', DateHelper::getStartOfYear($dt), '</td></tr>';
echo '<tr><td>Next Year</td><td>', DateHelper::getStartOfNextYear($dt), '</td></tr>';
echo '<tr><td>Prev Year</td><td>', DateHelper::getStartOfPrevYear($dt), '</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Holidays for ', date('Y');
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
foreach (DateHelper::getHolidays(substr($dt, 0, 4)) as $key => $holiday)
{
    echo'<tr><td>', $key, '</td><td>', $holiday, '</td></tr>';
}
echo '</table>';

echo '</body></html>';