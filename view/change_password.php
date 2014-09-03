<?php
/**
 * Created by PhpStorm.
 * User: cwilson
 * Date: 1/16/14
 * Time: 10:45 AM
 */
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="../style/change-password-style.css" />
    </head>
    <body>
        <form name="change_password" action="../query/change_password.php" method="post">
            <div id="banner-wrapper">
                <div class="bold-center">Change Password:</div>
                <div id="main-wrapper">
                    <div id="inner-wrapper">
                        <div class="left">User Name:</div>
                        <input type="text" name="user" />
                        <br />
                        <div class="left">Current Password:</div>
                        <input type="password" name="password" />
                        <br />
                        <div class="left">New Password:</div>
                        <input type="password" name="new_password" />
                        <br />
                        <div class="left">Retype New Password:</div>
                        <input type="password" name="confirm_password" />
                        <br />
                    </div>
                    <input class="button" type="submit" name="submit_button" value="Change Password" />
                </div>
            </div>
        </form>
    </body>
</html>