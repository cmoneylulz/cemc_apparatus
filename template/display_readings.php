<?php
/**
 * This code generates the list of available substation readings
 * Written by: Christopher Wilson
 * Date: November 19, 2013
 */

//TODO: Extract To View Generation Class

include_once('../query/SortQueries.php');

//TODO: Extract Method
if (!isset($_GET['station_name']) || $_GET['station_name'] == "All Stations")
{
    $sort_query = new SortQueries($_GET['sort_mode'], null);
} 

else 
{
    if ("all" == $_GET['station_name']) 
    {
        $sort_query = new SortQueries($_GET['sort_mode'], null);
    }

    else 
    {
        $sort_query = new SortQueries($_GET['sort_mode'], $_GET['station_name']);
    }
}

$query = mysql_query($sort_query->getSortQuery());
$color_row = false;

while ($row = mysql_fetch_assoc($query)) 
{
    $color_row = generateRow($color_row);
    generateColumns($row, $color_row);
    closeDiv();
}

/**
 * This method generates a new div row for a reading with a color class based on
 * the value of $color_row, a boolean value, will set the row to dark if true, or
 * light if false. Also toggles the value of $color_row
 * @param $color_row
 *      The color scheme to use (light or dark)
 * @return bool
 *      The new value of $color_row
 */
function generateRow($color_row)
{
    echo("<div class='");
    if ($color_row) 
    {
        echo("row-dark");
        $color_row = false;
    }

    else 
    {
        echo("row-light");
        $color_row = true;
    }

    echo("'>");
    return $color_row;
}

/**
 * Creates columns for each result returned by the sort query
 * @param $row
 *      The raw sql data for the current row
 * @param $color_row
 *      The color scheme to use for this row
 */
function generateColumns($row, $color_row)
{
    $date = explode("-", $row['read_date']);
    $month_list = array("January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December");

    openLink($row, $color_row);
    echo("<div class='float-left-wide'>");
    echo($row['station_name']);
    closeDiv();
    closeLink();

    openLink($row, $color_row);
    echo("<div class='float-left'>");
    echo($month_list[$date[1] - 1]);
    closeDiv();
    closeLink();

    openLink($row, $color_row);
    echo("<div class='float-left'>");
    echo($date[2]);
    closeDiv();
    closeLink();

    openLink($row, $color_row);
    echo("<div class='float-left'>");
    echo($date[0]);
    closeDiv();
    closeLink();
}

/**
 * Creates a new link for each column which will open the reading when clicked by
 * the reader
 * @param $row
 *      raw sql data for the current row
 * @param $color_row
 *      the color scheme to use for this link
 */
function openLink($row, $color_row)
{
    echo("<a class='");
    if ($color_row) 
    {
        echo("dark");
    }

    else 
    {
        echo("light");
    }

    echo("' href='viewread.php?station_name=" . $row['station_name'] . "&date=" . $row['read_date'] . "'>");
}

/**
 * Echos a closing link tag
 */
function closeLink()
{
    echo("</a>");
}

/**
 * Echos a closing div tag
 */
function closeDiv()
{
    echo("</div>");
}