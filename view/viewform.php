<?php

session_start();
verifyLogin();

function verifyLogin()
{
    if (!isset($_SESSION['login_status']))
    {
        header('Location:login.php');
    }

    if ($_GET['station_name'] == 'All Stations')
    {
        header('Location:../index.php?browse=true');
    }
}


include_once('../model/Station.php');

$date = $_GET['date'];

$station = new Station($_GET['station_name'], $date);

?>

<html lang="en">
	<head>
        <script src="/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../style/form-style.css" />
	</head>
	<body>
        <div class="wrapper">
            <form name="station_read" action="processread.php" method="post">
                <div id="nav-wrapper">
                    <div class="inner-banner" id="station-select">
                        <label for="station-select">Station: </label>
                        <?php include_once('../template/station_select_form.php'); ?>
                        <br />
                        <label for="date-select">Date: </label>
                        <?php include_once('../template/end_date_select_form.php'); ?>
                    </div>
                </div>
                <div class="table-wrapper">
                    <?php $station->buildForms(); ?>
                </div>
                <div>
                    <br />
                    <input type="button" class="button" name="back_button" onclick="history.go(-1)" value="Back" />
                    <a href="../index.php"><input type="button" class="button" name="home" value="Home" /></a>
                    <input type="reset" class="button-right" name="reset_button" />
                    <input type="submit" class="button-right" name="submit_button" />
                    <input type="hidden" name="date" value="<?php echo "$date"; ?>" />
                </div>
            </form>
        </div>
	</body>
</html>