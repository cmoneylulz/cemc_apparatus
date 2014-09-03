<?php
	include('../query/dbconnect.php');
	include('Breaker.php');
	include('Regulator.php');
    include('StationRead.php');

/**
 * Model class for a substation
 */
class Station {

		private $station_id;
		private $station_name;
        private $station_read;
		private $station_regulators = array();
		private $station_breakers = array();
		private $date;

    /**
     * Constructor for Station class
     * @param $name
     *      the station name
     * @param $date
     *      the read date
     */
    public function __construct($name, $date)
    {
        //TODO: Pen Testing / MySqli
        $this->station_name = mysql_real_escape_string($name);
        $this->date = mysql_real_escape_string($date);

        $query = mysql_query("SELECT * FROM station WHERE station_name = '$this->station_name';") or die(mysql_error());
        $row = mysql_fetch_assoc($query);

        $this->station_id = $row['station_id'];
        $this->station_read = new StationRead($this->station_id, $this->date);
        $this->station_regulators = $this->setRegulators();
        $this->station_breakers = $this->setBreakers();
    }

    /**
     * Submit form data for each regulator & breaker in this station
     */
    public function submitRead()
    {
        foreach ($this->station_regulators as $regulator) {
            $regulator->submitRegulatorRead();
        }
        foreach ($this->station_breakers as $breaker) {
            $breaker->submitBreakerRead();
        }
    }

    /**
     * Call each regulators & breakers' form builder methods for this station
     */
    public function buildForms()
    {
        foreach ($this->station_regulators as $regulator) {
            $regulator->buildRegulatorForms($this->date);
        }
        foreach ($this->station_breakers as $breaker) {
            $breaker->buildBreakerForms($this->date);
        }
    }

    /**
     * Call each regulators & breakers' display reading methods for this station
     * @param $date
     *      the read date
     */
    public function buildRead($date)
    {
        foreach ($this->station_regulators as $regulator) {
            $regulator->buildRegulatorRead($date);
        }
        foreach ($this->station_breakers as $breaker) {
            $breaker->buildBreakerRead($date);
        }
    }

    /**
     * Accessor for station ID
     * @return mixed
     *      the station ID
     */
    public function getStationID()
    {
        return $this->station_id;
    }

    /**
     * Accessor for station name
     * @return string
     *      the station name
     */
    public function getStationName()
    {
        return $this->station_name;
    }

    /**
     * Accessor for the array of regulators
     * @return array
     *      the list of regulators that belong to this station
     */
    public function getStationRegulators()
    {
        return $this->station_regulators;
    }

    /**
     * Accessor for the array of breakers
     * @return array
     *      the list of breakers that belong to this station
     */
    public function getStationBreakers()
    {
        return $this->station_breakers;
    }

    /**
     * Print the date
     * TODO: Model / View Separation
     */
    public function echoDate()
    {
        echo($this->date . "<br />");
    }

    /**
     * Accessor for the read corresponding to this station
     * @return StationRead
     *      the substation reading
     */
    public function getStationRead()
    {
        return $this->station_read;
    }

    private function setRegulators()
    {
        $array = array();
        $query = mysql_query("SELECT * FROM `station_regulator` where regulator_station_id = '$this->station_id';") or die(mysql_error());
        while ($row = mysql_fetch_assoc($query)) {
            $array[] = new Regulator($row['regulator_id']);
        }
        return $array;
    }

    private function setBreakers()
    {
        $array = array();
        $query = mysql_query("SELECT breaker_id FROM station_breaker where breaker_station_id = '$this->station_id';") or die(mysql_error());
        while ($row = mysql_fetch_assoc($query)) {
            $array[] = new Breaker($row['breaker_id']);
        }
        return $array;
    }

}

?>
