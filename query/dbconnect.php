<?PHP

	$database = "station_reads";
	
	global $connection;

    $connection = mysql_connect('localhost','root','3409tdafkjago');
	@mysql_select_db($database) or die("Database Error".mysql_error());

?>