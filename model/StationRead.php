<?php
/**
 * Created by PhpStorm.
 * User: cwilson
 * Date: 11/5/13
 * Time: 9:41 AM
 */

/**
 * Model class for a station reading
 * Class StationRead
 */
class StationRead
{

    private $read_id;
    private $read_date;
    private $station_id;

    /**
     * Constructor for the StationRead class
     * @param $station_id
     *      the id of this substation
     * @param $date
     *      the date of the substation reading
     */
    public function __construct($station_id, $date)
    {
        $this->station_id = $station_id;
        $this->read_date = $date;
        $this->setReadId();
    }

    /**
     * Accessor for read_id
     * @return mixed
     *      the read id
     */
    public function getReadId()
    {
        return $this->read_id;
    }

    /**
     * Mutator for read_id
     * @return mixed
     *      the correct or new readId for this reading
     */
    public function setReadId()
    {
        $this->read_id = $this->lookupReadId();
    }

    /**
     * Accessor for read_date
     * @return mixed
     *      the date for this reading
     */
    public function getReadDate()
    {
        return $this->read_date;
    }

    /**
     * Mutator for read_date
     * @param $date
     *      the new date
     */
    public function setReadDate($date)
    {
        $this->read_date = $date;
    }

    /**
     * Accessor for station_id
     * @return mixed
     *      the id of this station
     */
    public function getStationId()
    {
        return $this->station_id;
    }

    /**
     * Mutator for station_id
     * @param $id
     *      the new station id to use
     */
    public function setStationId($id)
    {
        $this->station_id = $id;
    }

    /**
     * Submit this station read to the DB
     */
    public function submitRead() 
    {
        include_once("../query/dbconnect.php");

        $query = "
            insert into `station_reads`.`station_read` (station_id, read_date)
            values ('$this->station_id', '$this->read_date');
        ";

        if (!mysql_query($query))
        {
            die('Error: ' . mysql_error());
        }

        echo "success";
    }

    /**
     * Update an existing station read with information from this station read's form data
     */
    public function updateRead()
    {
        include_once("..query/dbconnect.php");

        $query = "
            update  station_reads.station_read
            set     station_id = '$this->station_id',
                    read_date = '$this->read_date'
            where   station_read_id = '$this->read_id';
        ";

        if (!mysql_query($query))
        {
            die('Error: ' . mysql_error());
        }

        echo "success";
    }

    private function lookupReadId() //TODO: PEN TESTING
    {
        include_once("../query/dbconnect.php");

        $query = mysql_query("
            select  *
            from    station_read
            where   station_id = '$this->station_id' and
                    read_date = '$this->read_date';
        ");

        $row = mysql_fetch_assoc($query);
        
        return $row['station_read_id'];
    }
} 