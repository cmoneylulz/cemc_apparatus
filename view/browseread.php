<?php
    session_start();
    verifyLogin();
    function verifyLogin()
    {
        if (!isset($_SESSION['login_status'])){
            header('Location:login.php');
        }
    }
?>

<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../style/browse-style.css" />
    </head>
    <body>
        <div class="wrapper">
            <div id="nav-wrapper">
                <form action='../index.php' method='get' name='station_select_form'>
                    <div class="inner-banner">
                        <div class="height-align"><div id="nav-header">Filters:</div></div>
                        <div class="height-align">
                            <?php include_once("../template/station_select_form.php"); ?>
                        </div>
                    </div>
                    <div class="inner-banner">
                        <div class="height-align">
                            <?php include_once("../template/date_select_form.php"); ?>
                        </div>
                        <div class="height-align">
                            <?php include_once("../template/end_date_select_form.php"); ?>
                        </div>
                    </div>
                    <div class="inner-banner">
                        <div class="height-align">
                            <input type='submit' class='button' value='Filter' name='browse' />&nbsp;
                        </div>
                        <div class="height-align">
                            <input type='submit' class='button-bottom' value='View Reading' name='view_reading' />&nbsp;
                        </div>
                    </div>
                </form>
            </div>
            <!-- end top template /-->
            <div class="table-wrapper">
                <div class="row-dark">
                    <a href="../index.php?browse=yes&sort_mode=name"><div class="column-header-wide">Station Name: </div></a>
                    <a href="../index.php?browse=yes&sort_mode=month"><div class="column-header">Month: </div></a>
                    <a href="../index.php?browse=yes&sort_mode=day"><div class="column-header">Day: </div></a>
                    <a href="../index.php?browse=yes&sort_mode=year"><div class="column-header">Year: </div></a>
                </div>
                <?php include_once("../template/display_readings.php"); ?>
            </div>
            <div>
                <br />
                <input type="button" class="button" name="back_button" onclick="history.go(-1)" value="Back" />
                <a href="../index.php"><input type="button" class="button" name="home" value="Home" /></a>
                <a href="../index.php?logout=true"><input type="button" class="button-right" name="logout" value="Log Out" /></a>
            </div>
        </div>
    </body>
</html>