<?php
/**
 * Created by PhpStorm.
 * User: Christopher Wilson
 * Date: 11/14/13
 * Time: 3:34 PM
 */


include_once('../query/dbconnect.php');

processLogin();

function showLoginForm()
{
    include_once('../template/login_form.php');
}

function showErrorMessage()
{
    echo "Login failed, please try again.<br />";
}

function processLogin()
{
    $login_result = attemptLogin();
    switch ($login_result)
    {
        default :
            showLoginForm();
            break;

        case 1 :
            showErrorMessage();
            showLoginForm();
            break;

        case 0 :
            session_start();
            $_SESSION['login_status'] = true;
            header('Location:../index.php');
            break;
    }
}

function attemptLogin()
{
    if (isset($_POST['username']) && isset($_POST['password']))
    {
        return checkLogin($_POST['username'], $_POST['password']);
    }

    else
    {
        return -1;
    }
}

function checkLogin($username, $password)
{
    global $connection;

    $username = str_replace("'","''",$username);
    $password = md5($password);

    // Verify that user is in database
    $query = "SELECT password FROM station_users WHERE user_name = '$username';";
    $result = mysql_query($query, $connection);
    if (!$result || (mysql_numrows($result) < 1))
    {
        return 1; //Indicates username failure
    }

    // Retrieve password from result
    $dbarray = mysql_fetch_array($result);

    // Validate that password is correct
    if ($password == $dbarray['password']){
        return 0; //Success! Username and password confirmed
    }

    else 
    {
        return 1; //Indicates password failure
    }
}