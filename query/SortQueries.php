<?php
/**
 * Created by PhpStorm.
 * User: cwilson
 * Date: 11/12/13
 * Time: 12:53 PM
 */

class SortQueries 
{

    private $sort_query;

    public function __construct($sort_mode, $station_name) 
    {
        $this->setSortQuery($sort_mode, $station_name);
    }

    /**
    * @return mixed
    */
    public function getSortQuery()
    {
       return $this->sort_query;
    }

    /**
    * calculate the start date;
    * @param mixed $sort_query
    */
    public function setSortQuery($sort_mode, $station_name)
    {
        if ($station_name != null && $station_name != "all") 
        {
            $this->sort_query = "
                SELECT  station.station_name, station_read.read_date
                FROM    station_read
                JOIN    station ON station.station_id = station_read.station_id
                WHERE   station.station_name = '".$station_name."' AND
                        station_read.read_date BETWEEN '".$_REQUEST['startdate']."' AND '".$_REQUEST['date']."'
                ORDER BY station.station_name ASC, station_read.read_date DESC
                LIMIT 0, 20
            ";
        } 

        else 
        {
            switch ($sort_mode) 
            {
                case 'date' :
                    $this->sort_query = "
                        SELECT  station.station_name, station_read.read_date
                        FROM    station_read
                        JOIN    station ON station.station_id = station_read.station_id
                        ORDER BY station_read.read_date ASC
                        LIMIT 0, 20
                    ";
                    break;

                case 'month' :
                    $this->sort_query = "
                        SELECT  station.station_name, station_read.read_date
                        FROM    station_read
                        JOIN    station ON station.station_id = station_read.station_id
                        ORDER BY MONTH(station_read.read_date) DESC
                        LIMIT 0, 20
                    ";
                    break;

                case 'day' :
                    $this->sort_query = "
                        SELECT  station.station_name, station_read.read_date
                        FROM    station_read
                        JOIN    station ON station.station_id = station_read.station_id
                        ORDER BY DAY(station_read.read_date) DESC
                        LIMIT 0, 20
                    ";
                    break;

                case 'year' :
                    $this->sort_query = "
                        SELECT  station.station_name, station_read.read_date
                        FROM    station_read
                        JOIN    station ON station.station_id = station_read.station_id
                        ORDER BY YEAR(station_read.read_date) DESC
                        LIMIT 0, 20
                    ";
                    break;

                default :
                    $this->sort_query = "
                        SELECT  station.station_name, station_read.read_date
                        FROM    station_read
                        JOIN    station ON station.station_id = station_read.station_id
                        WHERE   station_read.read_date BETWEEN '".$_REQUEST['startdate']."' AND '".$_REQUEST['date']."'
                        ORDER BY station.station_name ASC, station_read.read_date DESC
                        LIMIT 0, 20
                    ";
                    break;
            }
        }
    }
}