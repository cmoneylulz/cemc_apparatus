<?php

include_once ("Regulator.php");

    /**
     * Class RegulatorRead: Represents a regulator reading for the specified regulator
     */
    class RegulatorRead {

        private $read;
        private $regulator_read_id;
        private $read_id;
        private $regulator_id;
        private $read_date;
        private $a_count;
        private $a_raise;
        private $a_lower;
        private $a_amp;
        private $a_high_voltage;
        private $a_low_voltage;
        private $a_comments;
        private $b_count;
        private $b_raise;
        private $b_lower;
        private $b_amp;
        private $b_high_voltage;
        private $b_low_voltage;
        private $b_comments;
        private $c_count;
        private $c_raise;
        private $c_lower;
        private $c_amp;
        private $c_high_voltage;
        private $c_low_voltage;
        private $c_comments;

        /**
         * Constructor for RegulatorRead Class
         * @param Regulator $regulator
         *      the regulator this read belongs too
         * @param $date
         *      the read date
         */
        public function __construct(Regulator $regulator, $date) {
            $this->regulator_id = $regulator->getID();
            $this->read = $this->getRegulatorRead($date);
            $this->regulator_read_id = $this->read['regulator_read_id'];
            $this->read_id = $this->read['read_id'];
            $this->read_date = $this->read['read_date'];
            $this->a_count = $this->read['a_count'];
            $this->a_raise = $this->read['a_raise'];
            $this->a_lower = $this->read['a_lower'];
            $this->a_amp = $this->read['a_amp'];
            $this->a_high_voltage = $this->read['a_high_voltage'];
            $this->a_low_voltage = $this->read['a_low_voltage'];
            $this->a_comments = $this->read['a_comments'];
            $this->b_count = $this->read['b_count'];
            $this->b_raise = $this->read['b_raise'];
            $this->b_lower = $this->read['b_lower'];
            $this->b_amp = $this->read['b_amp'];
            $this->b_high_voltage = $this->read['b_high_voltage'];
            $this->b_low_voltage = $this->read['b_low_voltage'];
            $this->b_comments = $this->read['b_comments'];
            $this->c_count = $this->read['c_count'];
            $this->c_raise = $this->read['c_raise'];
            $this->c_lower = $this->read['c_lower'];
            $this->c_amp = $this->read['c_amp'];
            $this->c_high_voltage = $this->read['c_high_voltage'];
            $this->c_low_voltage = $this->read['c_low_voltage'];
            $this->c_comments = $this->read['c_comments'];
        }

        /**
         * Retrieve the raw sql reading from the DB
         * @param $date
         *      the read date to search
         * @return array
         *      raw sql data
         * TODO: Pen Testing / MySQLi
         */
        public function getRegulatorRead($date) {
            $date = mysql_real_escape_string($date);
            $query = mysql_query("
				SELECT     *
				FROM       `station_regulator_read`
				WHERE      `regulator_id` = '$this->regulator_id'     AND
				           `read_date` = '$date';
			");
            return $row = mysql_fetch_assoc($query);
        }

        /**
         * Submit a reading for this breaker
         */
        public function submitRegulatorRead() {
            echo ($this->read_id." ".$this->regulator_read_id);
            if ($this->regulator_read_id != null) {
                $this->updateRegulatorRead();
                echo($this->read_id);
            } else {
                $this->insertRegulatorRead();
            }
        }

        private function updateRegulatorRead() {
            $query = mysql_query("
                UPDATE  `station_reads`.`station_regulator_read`
                SET     `read_date`='$this->read_date', `a_count`='$this->a_count', `a_raise`='$this->a_raise',
                        `a_lower`='$this->a_lower', `a_amp`='$this->a_amp', `a_high_voltage`='$this->a_high_voltage',
                        `a_low_voltage`='$this->a_low_voltage', `a_comments`='$this->a_comments',
                        `b_count`='$this->b_count', `b_raise`='$this->b_raise', `b_lower`='$this->b_lower',
                        `b_amp`='$this->b_amp', `b_high_voltage`='$this->b_high_voltage',
                        `b_low_voltage`='$this->b_low_voltage', `b_comments`='$this->b_comments',
                        `c_count`='$this->c_count', `c_raise`='$this->c_raise', `c_lower`='$this->c_lower',
                        `c_amp`='$this->c_amp', `c_high_voltage`='$this->c_high_voltage',
                        `c_low_voltage`='$this->c_low_voltage', `c_comments`='$this->c_comments'
                WHERE   `regulator_read_id`='$this->regulator_read_id' AND `read_id`='$this->read_id';
            ");
            return $query;
        }

        private function insertRegulatorRead() {
            $query = "
					INSERT     INTO     `station_reads`.`station_regulator_read` (
						                `read_id`, `regulator_id`, `read_date`, `a_count`, `a_raise`,
						                `a_lower`, `a_amp`, `a_high_voltage`,
						                `a_low_voltage`, `a_comments`, `b_count`,
						                `b_raise`, `b_lower`, `b_amp`, `b_high_voltage`,
						                `b_low_voltage`, `b_comments`, `c_count`,
						                `c_raise`, `c_lower`, `c_amp`, `c_high_voltage`,
						                `c_low_voltage`, `c_comments`)
					VALUES ('".$this->read_id ."', '".$this->regulator_id ."', '" . $this->read_date . "', '".$this->a_count."',
					        '".$this->a_raise ."', '".$this->a_lower ."', '".$this->a_amp ."',
					        '".$this->a_high_voltage ."', '".$this->a_low_voltage ."', '".$this->a_comments ."',
					        '".$this->b_count ."', '".$this->b_raise ."', '".$this->b_lower ."',
					        '".$this->b_amp ."', '".$this->b_high_voltage ."', '".$this->b_low_voltage ."',
					        '".$this->b_comments."', '".$this->c_count ."', '".$this->c_raise. "',
					        '".$this->c_lower."', '".$this->c_amp."', '".$this->c_high_voltage."',
					        '".$this->c_low_voltage."', '".$this->c_comments."');
			";
            if (!mysql_query($query)) {
                die('Error: ' . mysql_error());
            }
            echo "1 record added";
        }

        /**
         * Mutator for regulator read id
         * @param mixed $regulator_read_id
         *      the regulator read id
         */
        public function setRegulatorReadId($regulator_read_id)
        {
            $this->regulator_read_id = $regulator_read_id;
        }

        /**
         * Accessor for regulator read id
         * @return mixed
         *      the regulator read id
         */
        public function getRegulatorReadId()
        {
            return $this->regulator_read_id;
        }

        /**
         * Mutator for a_amp
         * @param mixed $a_amp
         *      the new amp values for a
         */
        public function setAAmp($a_amp)
        {
            $this->a_amp = $a_amp;
        }

        /**
         * Accessor for a_amp
         * @return mixed
         *      the amp values for a
         */
        public function getAAmp()
        {
            return $this->a_amp;
        }

        /**
         * Mutator for a_comments
         * @param mixed $a_comments
         */
        public function setAComments($a_comments)
        {
            $this->a_comments = $a_comments;
        }

        /**
         * Accessor for a_comments
         * @return mixed
         */
        public function getAComments()
        {
            return $this->a_comments;
        }

        /**
         * Mutator for a_count
         * @param mixed $a_count
         */
        public function setACount($a_count)
        {
            $this->a_count = $a_count;
        }

        /**
         * Accessor for a_count
         * @return mixed
         */
        public function getACount()
        {
            return $this->a_count;
        }

        /**
         * Mutator for a_high_voltage
         * @param mixed $a_high_voltage
         */
        public function setAHighVoltage($a_high_voltage)
        {
            $this->a_high_voltage = $a_high_voltage;
        }

        /**
         * Accessor for a_high_voltage
         * @return mixed
         */
        public function getAHighVoltage()
        {
            return $this->a_high_voltage;
        }

        /**
         * Mutator for a_low_voltage
         * @param mixed $a_low_voltage
         */
        public function setALowVoltage($a_low_voltage)
        {
            $this->a_low_voltage = $a_low_voltage;
        }

        /**
         * Accessor for a_low voltage
         * @return mixed
         */
        public function getALowVoltage()
        {
            return $this->a_low_voltage;
        }

        /**
         * Mutator for a_lower
         * @param mixed $a_lower
         */
        public function setALower($a_lower)
        {
            $this->a_lower = $a_lower;
        }

        /**
         * Accessor for a_lower
         * @return mixed
         */
        public function getALower()
        {
            return $this->a_lower;
        }

        /**
         * Mutator for a_raise
         * @param mixed $a_raise
         */
        public function setARaise($a_raise)
        {
            $this->a_raise = $a_raise;
        }

        /**
         * Accessor for a_raise
         * @return mixed
         */
        public function getARaise()
        {
            return $this->a_raise;
        }

        /**
         * mutator for b_amp
         * @param mixed $b_amp
         */
        public function setBAmp($b_amp)
        {
            $this->b_amp = $b_amp;
        }

        /**
         * Accessor for b_amp
         * @return mixed
         */
        public function getBAmp()
        {
            return $this->b_amp;
        }

        /**
         * Mutator for b_comments
         * @param mixed $b_comments
         */
        public function setBComments($b_comments)
        {
            $this->b_comments = $b_comments;
        }

        /**
         * Accessor for b_comments
         * @return mixed
         */
        public function getBComments()
        {
            return $this->b_comments;
        }

        /**
         * Mutator for b_count
         * @param mixed $b_count
         */
        public function setBCount($b_count)
        {
            $this->b_count = $b_count;
        }

        /**
         * Accessor for b_count
         * @return mixed
         */
        public function getBCount()
        {
            return $this->b_count;
        }

        /**
         * Accessor for b_high_voltage
         * @param mixed $b_high_voltage
         */
        public function setBHighVoltage($b_high_voltage)
        {
            $this->b_high_voltage = $b_high_voltage;
        }

        /**
         * Accessor for b_high_voltage
         * @return mixed
         */
        public function getBHighVoltage()
        {
            return $this->b_high_voltage;
        }

        /**
         * Mutator for b_low_voltage
         * @param mixed $b_low_voltage
         */
        public function setBLowVoltage($b_low_voltage)
        {
            $this->b_low_voltage = $b_low_voltage;
        }

        /**
         * Accessor for b_low voltage
         * @return mixed
         */
        public function getBLowVoltage()
        {
            return $this->b_low_voltage;
        }

        /**
         * Mutator for b_lower
         * @param mixed $b_lower
         */
        public function setBLower($b_lower)
        {
            $this->b_lower = $b_lower;
        }

        /**
         * Accessor for b_lower
         * @return mixed
         */
        public function getBLower()
        {
            return $this->b_lower;
        }

        /**
         * Mutator for b_raise
         * @param mixed $b_raise
         */
        public function setBRaise($b_raise)
        {
            $this->b_raise = $b_raise;
        }

        /**
         * Accessor for b_raise
         * @return mixed
         */
        public function getBRaise()
        {
            return $this->b_raise;
        }

        /**
         * mutator for c_amp
         * @param mixed $c_amp
         */
        public function setCAmp($c_amp)
        {
            $this->c_amp = $c_amp;
        }

        /**
         * accessor for c_amp
         * @return mixed
         */
        public function getCAmp()
        {
            return $this->c_amp;
        }

        /**
         * mutator for c_comments
         * @param mixed $c_comments
         */
        public function setCComments($c_comments)
        {
            $this->c_comments = $c_comments;
        }

        /**
         * accessor for c_comments
         * @return mixed
         */
        public function getCComments()
        {
            return $this->c_comments;
        }

        /**
         * mutator for c_count
         * @param mixed $c_count
         */
        public function setCCount($c_count)
        {
            $this->c_count = $c_count;
        }

        /**
         * accessor for c_count
         * @return mixed
         */
        public function getCCount()
        {
            return $this->c_count;
        }

        /**
         * mutator for c_high_voltage
         * @param mixed $c_high_voltage
         */
        public function setCHighVoltage($c_high_voltage)
        {
            $this->c_high_voltage = $c_high_voltage;
        }

        /**
         * accessor for c_high_voltage
         * @return mixed
         */
        public function getCHighVoltage()
        {
            return $this->c_high_voltage;
        }

        /**
         * mutator for c_low_voltage
         * @param mixed $c_low_voltage
         */
        public function setCLowVoltage($c_low_voltage)
        {
            $this->c_low_voltage = $c_low_voltage;
        }

        /**
         * accessor for c_low_voltage
         * @return mixed
         */
        public function getCLowVoltage()
        {
            return $this->c_low_voltage;
        }

        /**
         * mutator for c_lower
         * @param mixed $c_lower
         */
        public function setCLower($c_lower)
        {
            $this->c_lower = $c_lower;
        }

        /**
         * accessor for c_lower
         * @return mixed
         */
        public function getCLower()
        {
            return $this->c_lower;
        }

        /**
         * mutator for c_raise
         * @param mixed $c_raise
         */
        public function setCRaise($c_raise)
        {
            $this->c_raise = $c_raise;
        }

        /**
         * accessor for c_raise
         * @return mixed
         */
        public function getCRaise()
        {
            return $this->c_raise;
        }

        /**
         * mutator for read
         * @param mixed $read
         */
        public function setRead($read)
        {
            $this->read = $read;
        }

        /**
         * accessor for read
         * @return mixed
         */
        public function getRead()
        {
            return $this->read;
        }

        /**
         * mutator for read_date
         * @param mixed $read_date
         */
        public function setReadDate($read_date)
        {
            $this->read_date = $read_date;
        }

        /**
         * accessor for read_date
         * @return mixed
         */
        public function getReadDate()
        {
            return $this->read_date;
        }

        /**
         * mutator for read_id
         * @param mixed $read_id
         */
        public function setReadId($read_id)
        {
            $this->read_id = $read_id;
        }

        /**
         * accessor for read_id
         * @return mixed
         */
        public function getReadId()
        {
            return $this->read_id;
        }

        /**
         * mutator for regulator_id
         * @param mixed $regulator_id
         */
        public function setRegulatorId($regulator_id)
        {
            $this->regulator_id = $regulator_id;
        }

        /**
         * accessor for regulator_id
         * @return mixed
         */
        public function getRegulatorId()
        {
            return $this->regulator_id;
        }

    }