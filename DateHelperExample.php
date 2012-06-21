<?php

include_once __DIR__ . DIRECTORY_SEPARATOR . 'DateHelper.php';


$n = DateHelper::getStartOfNextDay();
$p = DateHelper::getStartOfPrevDay();

echo '<table>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Day: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Now</td><td>', DateHelper::getNow(), '</td></tr>';
echo '<tr><td>Start of Day</td><td>', DateHelper::getStartOfDay(), '</td></tr>';
echo '<tr><td>Next Day</td><td>', $n;
echo '<tr><td>Prev Day</td><td>', $p;
echo '<tr><td>Next Business Day</td><td>', DateHelper::getNextBusinessDay(), '</td></tr>';
echo '<tr><td>Prev Business Day</td><td>', DateHelper::getPrevBusinessDay(), '</td></tr>';
echo '<tr><td>Days between Prev/Next</td><td>', DateHelper::getDays($p, $n), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Week: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Week</td><td>', DateHelper::getStartOfWeek(), '</td></tr>';
echo '<tr><td>Next Week</td><td>', DateHelper::getStartOfNextWeek(), '</td></tr>';
echo '<tr><td>Prev Week</td><td>', DateHelper::getStartOfPrevWeek(), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Month: START/END/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Month</td><td>', DateHelper::getStartOfMonth(), '</td></tr>';
echo '<tr><td>End of Month</td><td>', DateHelper::getEndOfMonth(), '</td></tr>';
echo '<tr><td>Next Month</td><td>', DateHelper::getStartOfNextMonth(), '</td></tr>';
echo '<tr><td>Prev Month</td><td>', DateHelper::getStartOfPrevMonth(), '</td></tr>';
echo '<tr><td>Last Business Day in Month</td><td>', DateHelper::getLastBusinessDay(), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Quarter: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Quarter</td><td>', DateHelper::getStartOfQuarter(), '</td></tr>';
echo '<tr><td>Next Quarter</td><td>', DateHelper::getStartOfNextQuarter(), '</td></tr>';
echo '<tr><td>Prev Quarter</td><td>', DateHelper::getStartOfPrevQuarter(), '</td></tr>';
echo '<tr><td></tr><tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Year: START/NEXT/PREV</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td>Start of Year</td><td>', DateHelper::getStartOfYear(), '</td></tr>';
echo '<tr><td>Next Year</td><td>', DateHelper::getStartOfNextYear(), '</td></tr>';
echo '<tr><td>Prev Year</td><td>', DateHelper::getStartOfPrevYear(), '</td></tr>';
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
echo '<tr><td colspan="2">-- Holidays for ', date('Y');
echo '<tr><td colspan="2">----------------------------------------------------------------</td></tr>';
foreach (DateHelper::getHolidays(date('Y')) as $key => $holiday)
{
    echo'<tr><td>', $key, '</td><td>', $holiday, '</td></tr>';
}
echo '</table>';
