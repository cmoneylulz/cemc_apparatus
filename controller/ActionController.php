<?php
/**
 * This class processes form input sent to index.php and redirects the user to the
 * requested form or substation reading
 * Created by PhpStorm.
 * User: Christopher Wilson
 * Date: 11/12/13
 * Time: 8:23 AM
 */

class ActionController 
{

    private $action;
    private $station_name;
    private $date;
    private $start_date;
    private $sort_mode;
    private $header;

    /**
     * Constructor for the ActionController class
     */
    public function __construct() 
    {
        $this->setDateRange();
        $this->checkLogin();
    }

    /**
     * Redirects the user to various views based on the action currently set
     * @requires none
     */
    public function processAction() 
    {
        $this->buildHeader();
        header($this->header);
    }

    /**
     * Processes raw form data from the user and determines an action based
     * on the input.
     */
    private function setAction()
    {
        if (isset($_GET['station_name']))
        {
            $this->station_name = $_GET['station_name'];
        }

        if (isset($_GET['new_reading']))
        {
            $this->action = 'new';
        }

        if (isset($_GET['view_reading']))
        {
            $this->action = 'view';
        }

        if (isset($_GET['logout']))
        {
            $this->action = 'logout';
        }

        if (isset($_GET['browse']))
        {
            $this->action = 'browse';
            $this->setSortMode();
        }

        if (!isset($this->action))
        {
            $this->action = 'menu';
        }
    }

    /**
     * Used to set the sort mode for the browseread.php view
     */
    private function setSortMode()
    {
        if (!isset($_GET['sort_mode']))
        {
            $this->sort_mode = 'default';

            if (isset($this->station_name))
            {
                $this->sort_mode = $this->sort_mode . '&station_name=' . $this->station_name;
            }
        } 

        else 
        {
            $this->sort_mode = $_GET['sort_mode'];
        }
    }

    /**
     * Used to check if the user is logged in before processing any input
     * if not logged in, it will redirect the user to the login screen.
     */
    private function checkLogin()
    {
        if (!isset($_SESSION['login_status']))
        {
            $this->action = 'login';
        }

        else
        {
            $this->setAction();
        }
    }

    private function setDateRange()
    {
        $this->setDate();
        $this->setStartDate();
    }

    private function setDate()
    {
        if (!isset($_GET['day']) && !isset($_GET['month']) && !isset($_GET['year']))
        {
            $raw_date = getDate();
            $this->date = $raw_date['year'] . "-" . $raw_date['mon'] . "-" . $raw_date['mday'];
        }

        else
        {
            $this->date = $_GET['year'] . "-" . $_GET['month'] . "-" . $_GET['day'];
        }
    }

    private function setStartDate()
    {
        if (isset($_GET['start_day']) && isset($_GET['start_month']) && isset($_GET['start_year']))
        {
            $this->start_date = $_GET['start_year'] . "-" . $_GET['start_month'] . "-" . $_GET['start_day'];
        }

        else
        {
            $this->start_date = "2000-1-1";
        }
    }

    private function buildHeader()
    {
        $this->header = 'Location:view/';
        switch ($this->action)
        {
            case 'menu' :
                $this->header .= 'menu.php';
                break;

            case 'logout' :
                session_destroy();
                $this->header = 'Location:index.php';
                break;

            case 'view' :
                $this->header .= 'viewread.php?station_name=' . $this->station_name . '&date=' . $this->date;
                break;

            case 'new' :
                $this->header .= 'viewform.php?station_name=' . $this->station_name . '&date=' . $this->date;
                break;

            case 'browse' :
                $this->header .= 'browseread.php?sort_mode=' . $this->sort_mode . '&startdate=' . $this->start_date . '&date=' . $this->date;
                break;
                
            default :
                $this->header .= "login.php";
                break;
        }
    }
}