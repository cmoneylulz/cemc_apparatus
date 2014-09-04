<?php
/**
 * Created by PhpStorm.
 * User: cwilson
 * Date: 10/25/13
 * Time: 11:52 AM
 */

session_start();
verifyLogin();
function verifyLogin()
{
    if (!isset($_SESSION['login_status'])){
        header('Location:login.php');
    }
}

include_once("../model/Station.php");
include_once("../model/Regulator.php");
include_once("../model/Breaker.php");
include_once("../model/RegulatorRead.php");
include_once("../model/BreakerRead.php");
include_once("../model/StationRead.php");

if (isset($_POST['date']))
{
    $date = $_POST['date'];
}

else
{
    $date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
}

$new_date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
$station = new Station($_POST['station_name'], $date);
$station_read = $station->getStationRead();

//TODO: Refactor this logic into the StationRead class
//CHECK IF NEW OR EDIT
if ($station_read->getReadId() == null)
{
    $station_read->submitRead();
    $station_read->setReadId();
}

else
{
    $station_read->setReadDate($new_date);
}

foreach ($station->getStationRegulators() as $sr)
{
    $rid = $sr->getID();
    $rr = new RegulatorRead($sr, $date);
    $rr->setReadId($station_read->getReadId());
    $rr->setReadDate($new_date);
    $rr->setACount($_POST['r'. $rid.'a_count']);
    $rr->setARaise($_POST['r'. $rid.'a_raise']);
    $rr->setALower($_POST['r'. $rid.'a_lower']);
    $rr->setAAmp($_POST['r'. $rid.'a_amp']);
    $rr->setAHighVoltage($_POST['r'. $rid.'a_high_voltage']);
    $rr->setALowVoltage($_POST['r'. $rid.'a_low_voltage']);
    $rr->setAComments($_POST['r'. $rid.'a_comments']);
    $rr->setBCount($_POST['r'. $rid.'b_count']);
    $rr->setBRaise($_POST['r'. $rid.'b_raise']);
    $rr->setBLower($_POST['r'. $rid.'b_lower']);
    $rr->setBAmp($_POST['r'. $rid.'b_amp']);
    $rr->setBHighVoltage($_POST['r'. $rid.'b_high_voltage']);
    $rr->setBLowVoltage($_POST['r'. $rid.'b_low_voltage']);
    $rr->setBComments($_POST['r'. $rid.'b_comments']);
    $rr->setCCount($_POST['r'. $rid.'c_count']);
    $rr->setCRaise($_POST['r'. $rid.'c_raise']);
    $rr->setCLower($_POST['r'. $rid.'c_lower']);
    $rr->setCAmp($_POST['r'. $rid.'c_amp']);
    $rr->setCHighVoltage($_POST['r'. $rid.'c_high_voltage']);
    $rr->setCLowVoltage($_POST['r'. $rid.'c_low_voltage']);
    $rr->setCComments($_POST['r'. $rid.'c_comments']);
    $rr->submitRegulatorRead();
}

foreach ($station->getStationBreakers() as $sb)
{
    $bid = $sb->getID();
    $br = new BreakerRead($sb, $date);
    $br->setReadId($station_read->getReadId());
    $br->setReadDate($new_date);
    $br->setCount($_POST['b'. $bid.'count']);
    $br->setAFlag($_POST['b'. $bid.'a_flag']);
    $br->setBFlag($_POST['b'. $bid.'b_flag']);
    $br->setCFlag($_POST['b'. $bid.'c_flag']);
    $br->setNFlag($_POST['b'. $bid.'n_flag']);
    $br->setBattery($_POST['b'. $bid.'battery']);

    if ($sb->hasMult() == 1 && $sb->hasAmp() == 1)
    {
        $br->setAAmps($_POST['b'. $bid.'a_amps']);
        $br->setBAmps($_POST['b'. $bid.'b_amps']);
        $br->setCAmps($_POST['b'. $bid.'c_amps']);
        $br->setAMult($_POST['b'. $bid.'a_mult']);
        $br->setBMult($_POST['b'. $bid.'b_mult']);
        $br->setCMult($_POST['b'. $bid.'c_mult']);
    }

    else if ($sb->hasMult() == 1 && $sb->hasAmp() == 0)
    {
        $br->setAMult($_POST['b'. $bid.'a_mult']);
        $br->setBMult($_POST['b'. $bid.'b_mult']);
        $br->setCMult($_POST['b'. $bid.'c_mult']);
    }

    else
    {
        $br->setAAmps($_POST['b'. $bid.'a_amps']);
        $br->setBAmps($_POST['b'. $bid.'b_amps']);
        $br->setCAmps($_POST['b'. $bid.'c_amps']);
    }

    $br->setComments($_POST['b'. $bid.'comments']);
    $br->submitBreakerRead();
}

$station_read->updateRead();

header('Location:../view/viewread.php?station_name='. $_POST["station_name"] . '&date='. $new_date);