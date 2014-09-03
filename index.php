<?php
/**
 * Created by PhpStorm.
 * User: Christopher Wilson
 * Date: 11/12/13
 * Time: 8:33 AM
 */

    include_once('controller/ActionController.php');

    session_start();

    $action_controller = new ActionController();
    $action_controller->processAction();
?>