<?php
/**
 * This class represents the model for the station_breaker table.
 * It stores information about which fields are necessary when
 * displaying breaker information.
 *
 * TODO: Refactor this class and remove controller/view functions into a separate classes.
 */

include_once ("BreakerRead.php");

	class Breaker {

		private $id;
		private $name;
		private $mult_header;
		private $has_mult;
		private $has_amp;
        private $breakerRead;

        /**
         * Constructor method for the breaker class
         * @param $id
         *      the breaker_id
         */
        public function __construct($id)
        {
			include_once("../query/dbconnect.php");
			$query = mysql_query("SELECT * FROM station_breaker WHERE breaker_id = $id");
			$row = mysql_fetch_assoc($query);
			$this->id = $id;
			$this->name = $row['breaker_name'];
			$this->has_mult = $row['breaker_has_mult'];
			$this->has_amp = $row['breaker_has_amp'];
			if ($this->has_mult != 0)
            {
				$this->mult_header = $row['breaker_mult_header'];
			}
		}

        /**
         * Fetch a reading for this breaker
         * @param $date
         *      the date of the reading
         * @return array
         *      raw sql data
         */
        public function getBreakerRead($date)
        {
			include_once('../query/dbconnect.php');
			$query = mysql_query("
				SELECT     *
				FROM       `station_breaker_read`
				WHERE      `breaker_id` = '$this->id'     AND
				           `read_date` = '$date';
			");
			return $row = mysql_fetch_assoc($query);
		}

        /**
         * Either Update or Insert current form data from this breaker's reading
         * into the database
         * TODO: Is this a controller activity?
         */
        public function submitBreakerRead()
        {
            $this->breakerRead->submitBreakerRead();
        }

        /**
         * Generate forms for this breaker
         * TODO: Move to View
         * @param $date
         *      the date to use for this reading
         */
        public function buildBreakerForms($date)
        {
            $this->breakerRead = new BreakerRead($this, $date);
			$this->buildBreakerHeading();
			$this->buildBreakerCountForms($this->breakerRead);
			$this->buildBreakerMultForms($this->breakerRead);
			$this->buildBreakerAmpForms($this->breakerRead);
		}

        /**
         * Generate & Polulate fields for viewing read data for this breaker
         * @param $date
         *      The read date to use
         */
        public function buildBreakerRead($date)
        {
			$this->breakerRead = new BreakerRead($this, $date);
			$this->buildBreakerHeading();
			$this->buildBreakerCountRead($this->breakerRead);
			$this->buildBreakerMultRead($this->breakerRead);
			$this->buildBreakerAmpRead($this->breakerRead);
		}

        /**
         * Accessor for this breaker's ID
         * @return $id
         *      this breakers id value
         */
        public function getID()
        {
			return $this->id;
		}

        /**
         * Accessor for this breaker's Name
         * @return $name
         *      the name of this breaker
         */
        public function getName()
        {
			return $this->name;
		}

        /**
         * Accessor for this breakers Mult header
         * @return $mult_header
         *      The header value for the mult column
         */
        public function getMultHeader()
        {
			return $this->mult_header;
		}

        /**
         * Method returns true if this breaker has a mult header, and false if it does not
         * @return $has_mult
         */
        public function hasMult()
        {
			return $this->has_mult;
		}

        /**
         * Method returns true if this breaker has an amp header, returns false if not
         * @return mixed
         */
        public function hasAmp()
        {
			return $this->has_amp;
		}

		private function buildBreakerHeading()
        {
			echo("<div class='row-header'>");
			echo("<div class='column-header-small'>" . $this->name . "</div>");
			echo("<div class='column-header'>Count</div>");
			echo("<div class='column-header'>A</div>");
			echo("<div class='column-header'>B</div>");
			echo("<div class='column-header'>C</div>");
			echo("<div class='column-header'>N</div>");
			echo("<div class='column-header'>Battery</div>");
			echo("<div class='column-header'>Comments</div>");
			echo("</div>");
		}

		private function buildBreakerCountForms(BreakerRead $breakerRead)
        {
			echo("<div class='row'>");
			echo("<div class='column-small'></div>");
			echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "count' value='".$breakerRead->getCount()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "a_flag' value='".$breakerRead->getAFlag()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "b_flag' value='".$breakerRead->getBFlag()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "c_flag' value='".$breakerRead->getCFlag()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "n_flag' value='".$breakerRead->getNFlag()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "battery' value='".$breakerRead->getBattery()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "comments' value='".$breakerRead->getComments()."' /></div>");
			echo("</div>");
		}

		private function buildBreakerMultForms(BreakerRead $breakerRead)
        {
			if($this->has_mult > 0)
            {
                if($this->has_amp > 0)
                {
				    echo("<div class='row'>");
                } else {
                    echo("<div class='row-bottom'>");
                }
				echo("<div class='column-small'></div>");
				echo("<div class='column-bold'>Mult " . $this->mult_header . "</div>");
				echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "a_mult' value='".$breakerRead->getAMult()."' /></div>");
				echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "b_mult' value='".$breakerRead->getBMult()."' /></div>");
				echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "c_mult' value='".$breakerRead->getCMult()."' /></div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("</div>");
			}
		}

		private function buildBreakerAmpForms(BreakerRead $breakerRead)
        {
			if($this->has_amp > 0)
            {
				echo("<div class='row-bottom'>");
				echo("<div class='column-small'></div>");
				echo("<div class='column-bold'>Amps</div>");
				echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "a_amps' value='".$breakerRead->getAAmps()."' /></div>");
				echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "b_amps' value='".$breakerRead->getBAmps()."' /></div>");
				echo("<div class='column'><input type='text' class='text-box' name='b" . $this->id . "c_amps' value='".$breakerRead->getCAmps()."' /></div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("</div>");
			}
		}

		private function buildBreakerCountRead(BreakerRead $breakerRead)
        {
			echo("<div class='row'>");
			echo("<div class='column-small'></div>");
			echo("<div class='column'>".$breakerRead->getCount()."</div>");
			echo("<div class='column'>".$breakerRead->getAFlag()."</div>");
			echo("<div class='column'>".$breakerRead->getBFlag()."</div>");
			echo("<div class='column'>".$breakerRead->getCFlag()."</div>");
			echo("<div class='column'>".$breakerRead->getNFlag()."</div>");
			echo("<div class='column'>".$breakerRead->getBattery()."</div>");
			echo("<div class='column'>".$breakerRead->getComments()."</div>");
			echo("</div>");
		}

		private function buildBreakerMultRead(BreakerRead $breakerRead)
        {
			if($this->has_mult > 0)
            {
				echo("<div class='row'>");
				echo("<div class='column-small'></div>");
				echo("<div class='column-bold'>Mult " . $this->mult_header . "</div>");
				echo("<div class='column'>".$breakerRead->getAMult()."</div>");
				echo("<div class='column'>".$breakerRead->getBMult()."</div>");
				echo("<div class='column'>".$breakerRead->getCMult()."</div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("</div>");
			}
		}

		private function buildBreakerAmpRead(BreakerRead $breakerRead)
        {
			if($this->has_amp > 0)
            {
				echo("<div class='row'>");
				echo("<div class='column-small'></div>");
				echo("<div class='column-bold'>Amps</div>");
				echo("<div class='column'>".$breakerRead->getAAmps()."</div>");
				echo("<div class='column'>".$breakerRead->getBAmps()."</div>");
				echo("<div class='column'>".$breakerRead->getCAmps()."</div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("<div class='column'></div>");
				echo("</div>");
			}
		}
	}
?>