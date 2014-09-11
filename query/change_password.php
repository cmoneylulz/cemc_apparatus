<?php
/**
 * Created by PhpStorm.
 * User: cwilson
 * Date: 12/26/13
 * Time: 2:59 PM
 */

//Instance Variables

$success = true;

if (isset($_POST['user'])
{
    $user = $_POST['user'];
} 

else 
{
    $user = null;
    $success = false;
}

if (isset($_POST['password']))
{
    $password = $_POST['password'];
} 

else 
{
    $password = null;
    $success = false;
}

if (isset($_POST['new_password']))
{
    $new_password = $_POST['new_password'];
} 

else 
{
    $new_password = null;
    $success = false;
}

if (isset($_POST['confirm_password']))
{
    $confirm_password = $_POST['confirm_password'];
}

else 
{
    $confirm_password = null;
    $success = false;
}

if ($success) 
{
    include_once('dbconnect.php');
    $query = "SELECT * FROM `station_users` WHERE user_name='".mysql_real_escape_string($user)."'";
    $result = mysql_query($query, $connection);
    echo $result;
    $data = mysql_fetch_array($result);
    $current_password = $data[2];

    if ($current_password == md5($password) and $new_password == $confirm_password)
    {
        $query="UPDATE station_users SET password='".md5($new_password)."' where user_name='".
            str_replace("'","''",$data[1])."'";
        mysql_query($query, $connection);
    }
}