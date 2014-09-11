<?php
    session_start();
    verifyLogin();
    
    function verifyLogin()
    {
        if (!isset($_SESSION['login_status']))
        {
            header('Location:login.php');
        }
    }
?>

<html lang="en">
	<head>
        <link rel="stylesheet" type="text/css" href="../style/form-style.css" />
	</head>

	<body>
		<?php

			include_once('../model/Station.php');

			$read_date = $_GET['date'];
            $station = new Station(urldecode($_GET["station_name"]), $read_date);
            if ($station->getStationRead()->getReadId() == null) {
                header("location:../index.php?browse=yes&station_name=" . $station->getStationName());
            }
		?>
        <div class="wrapper">
		    <form name="edit_read" action="viewform.php" method="get">
                <div id="nav-wrapper">
                    <div class = "inner-banner">
                        Station: <?php echo($station->getStationName()); ?><br />Date: <?php echo($read_date); ?>
                    </div>
                </div>
                <div class="table-wrapper">
                    <?php $station->buildRead($read_date); ?>
                </div>
                <div>
                    <input type="hidden" name="station_name" value="<?php echo($_GET["station_name"]); ?>" /><br />
                    <input type="hidden" name="date" value="<?php echo($read_date); ?>" />
                    <input type="button" name="back_button" class="button" value="Back" onclick="history.go(-1)" />
                    <a href="../index.php"><input type="button" class="button" name="home" value="Home" /></a>
                    <input type="submit" class="button-right" name="edit_button" value="Edit" />
                </div>
		    </form>
        </div>
	</body>
</html>