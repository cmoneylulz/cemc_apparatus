<?php
/**
 * Created by PhpStorm.
 * User: Christopher Wilson
 * Date: 11/15/13
 * Time: 10:01 AM
 */

session_start();
verifyLogin();

function verifyLogin()
{
    if (!isset($_SESSION['login_status']))
    {
        header('Location:login.php');
    }

    else
    {
        drawPage();
    }
}

function drawPage()
{
    echo "<html lang='en'>";
    echo "<head><link rel='stylesheet' type='text/css' href='../style/menu-style.css' /></head>";
    echo "<body>";
    echo "<div id='main-wrapper'>";
    echo "<div id='banner'>";
    echo "<div id='banner-text'>Substation Readings</div>";
    echo "</div>";
    drawForm();
    echo "<a href='../index.php?logout=true'><input class='button-right' name='logout' value='Log Out' type='submit' /></a>";
    echo "<a href='../view/change_password.php'><input class='button-right' name='change_pass' value='New Password' type='submit' /></a>";
    echo "</div>";
    echo "</body>";
    echo "</html>";
}

function drawForm()
{
    echo "<div class='center'>";
    echo "<form name='station_select' action='../index.php' method='get'>";
    echo "<input name='new_reading' value='true' type='hidden' />";
    echo "<input type='submit' name='browse' value='Search Readings' class='station-button' />";
    generateButtons();
    echo "</form>";
    echo "</div>";
}

function generateButtons()
{
    include('../query/dbconnect.php');
    $query = mysql_query("SELECT * FROM station") or die(mysql_error());

    while($row = mysql_fetch_assoc($query))
    {
        drawButton($row["station_name"]);
    }
}

function drawButton($station_name)
{
    echo "<input type='submit' name='station_name' value='".$station_name."' class='station-button' />";
}
