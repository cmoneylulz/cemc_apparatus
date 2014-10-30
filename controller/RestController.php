<?php

if (isset($_POST["request"]))
{
	if ($_POST["request"] == "station_list")
	{
		getStationList();
	}

	if ($_POST["request"] == "get_breakers")
	{
		listBreakerIds($_POST["station_id"]); //validate
	}

	if ($_POST["request"] == "get_regulators")
	{
		listRegulatorIds($_POST["station_id"]); //validate
	}

	if ($_POST["request"] == "build_regulator")
	{
		listRegulatorInfo($_POST["regulator_id"]); //validate
	}

	if ($_POST["request"] == "build_breaker")
	{
		listBreakerInfo($_POST["breaker_id"]); //validate
	}
}

function getStationList()
{
	include('../query/dbconnect.php');

	$json_array = array();
	
    $query = mysql_query("SELECT * FROM station") or die(mysql_error());

    while($row = mysql_fetch_assoc($query))
    {
        $json = array("station_id" => $row["station_id"], "station_name" => $row["station_name"]);
        $json_array[] = $json;
    }

    echo(json_encode($json_array));
}

function listRegulatorIds($station_id)
{
	include('../query/dbconnect.php');

	$json_array = array();

	$query = mysql_query("SELECT * FROM `station_regulator` where regulator_station_id = '$station_id';") or die(mysql_error());

    while ($row = mysql_fetch_assoc($query)) 
    {
        $json = array("regulator_id" => $row['regulator_id']);
        $json_array[] = $json;
    }

    echo(json_encode($json_array));
}

function listBreakerIds($station_id)
{
	include('../query/dbconnect.php');

	$json_array = array();
	
	$query = mysql_query("SELECT breaker_id FROM station_breaker where breaker_station_id = '$station_id';") or die(mysql_error());

    while ($row = mysql_fetch_assoc($query))
    {
        $json = array("breaker_id" => $row['breaker_id']);
        $json_array[] = $json;            
    }

    echo(json_encode($json_array));
}

function listRegulatorInfo($regulator_id)
{
	include_once('../query/dbconnect.php');

	$query = mysql_query("SELECT * FROM station_regulator WHERE regulator_id = $regulator_id");
	$row = mysql_fetch_assoc($query);

	$json = array(
		'regulator_name' => $row['regulator_name'], 
		'regulator_amp_header' => $row['regulator_amp_header']
	);
	
	echo(json_encode($json));
}

/*
function listBreakerInfo($breaker_id)
{
	include_once("../query/dbconnect.php");

	$query = mysql_query("SELECT * FROM station_breaker WHERE breaker_id = $breaker_id");
	$row = mysql_fetch_assoc($query);
	$json_array = array();
	$json_array['cols'] = array(
		array('label' => 'breaker_name', 'type' => 'text'),
		array('label' => 'breaker_mult_header', 'type' => 'number'),
		array('label' => 'breaker_has_mult', 'type' => 'text'),
		array('label' => 'breaker_has_amp', 'type' => 'text'),
	);

	$json = array(
		'breaker_name' => $row['breaker_name'], 
		'breaker_mult_header' => $row['breaker_mult_header'], 
		'breaker_has_mult' => $row['breaker_has_mult'], 
		'breaker_has_amp' => $row['breaker_has_amp']
	);

	$json_array['rows'] = $json;

	echo(json_encode($json_array));
}
*/
function listBreakerInfo($breaker_id)
{
	include_once("../query/dbconnect.php");

	$query = mysql_query("SELECT * FROM station_breaker WHERE breaker_id = $breaker_id");
	$row = mysql_fetch_assoc($query);

	$json = array(
		'breaker_name' => $row['breaker_name'], 
		'breaker_mult_header' => $row['breaker_mult_header'], 
		'breaker_has_mult' => $row['breaker_has_mult'], 
		'breaker_has_amp' => $row['breaker_has_amp']
	);

	echo(json_encode($json));
}