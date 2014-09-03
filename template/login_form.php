<?php
/**
 * Created by PhpStorm.
 * User: Christopher Wilson
 * Date: 11/15/13
 * Time: 8:44 AM
 */
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../style/login-style.css" />
    </head>
    <body>
        <form name='login-form' action='login.php' method='post'>
            <div id="banner-wrapper">
                <div class="bold-center">Please Login:</div>
                <div id="main-wrapper">
                    <div id="inner-wrapper">
                        <div class='left'>User Name: </div>
                        <input name='username' id='user-input' type='text' />
                        <br />
                        <div class='left'>Password: </div>
                        <input name='password' id='password-input' type='password' />
                        <br />
                    </div>
                    <input name='login_button' class='button' type='submit' />
                    <input name='reset_button' class='button' type='reset' />
                </div>
            </div>
        </form>
    </body>
</html>