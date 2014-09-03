<?php
    //TODO: include OO Edit & Form Generation
/**
 * This class represents a regulator for a substation. It contains several form rendering methods that
 * need to be moved to a view class when time permits. May be possible to move entire class to View
 */
include_once("RegulatorRead.php");
	class Regulator {

		private $id;
		private $name;
		private $amp_header;
        private $regulatorRead;

        /**
         * Constructor for Regulator class
         * @param $id
         *      the regulator_id for this regulator (from sql)
         */
        public function __construct($id)
        {
			include_once('../query/dbconnect.php');
            $id = mysql_real_escape_string($id);
            //TODO: Pen Testing / update to MySqli
			$query = mysql_query("SELECT * FROM station_regulator WHERE regulator_id = $id");
			$row = mysql_fetch_assoc($query);
			$this->id = $id;
			$this->name = $row['regulator_name'];
			$this->amp_header = $row['regulator_amp_header'];
		}

        /**
         * Submits this stations regulator reading to the sql server
         */
        public function submitRegulatorRead()
        {
            $this->regulatorRead->submitRegulatorRead();
        }

        /**
         * Builds the forms for editing or creating a new reading on this regulator
         * @param $date
         *      the date of the substation reading
         */
        public function buildRegulatorForms($date)
        {
            $this->regulatorRead = new RegulatorRead($this, $date);
			$this->buildRegulatorHeading();
			$this->buildRegulatorAForms($this->regulatorRead);
			$this->buildRegulatorBForms($this->regulatorRead);
			$this->buildRegulatorCForms($this->regulatorRead);
		}

        /**
         * Build the div tables necessary to display a reading for this regulator
         * @param $date
         *      the date of the substation reading
         */
        public function buildRegulatorRead($date)
        {
            $this->regulatorRead = new RegulatorRead($this, $date);
			$this->buildRegulatorHeading();
			$this->buildRegulatorARead($this->regulatorRead);
			$this->buildRegulatorBRead($this->regulatorRead);
			$this->buildRegulatorCRead($this->regulatorRead);
		}

        /**
         * Accessor for regulator_read
         * @param $date
         *      the date of the substation read
         * @return array
         *      raw sql data
         */
        public function getRegulatorRead($date)
        {
            //TODO: Pen Testing / MySqli
            $date = mysql_real_escape_string($date);
            $query = mysql_query("
				SELECT     *
				FROM       `station_regulator_read`
				WHERE      `regulator_id` = '$this->id'     AND
				           `read_date` = '$date';
			");
            return $row = mysql_fetch_assoc($query);
        }

        /**
         * Accessor for regulator_id
         * @return string
         *      the regulator_id
         */
        public function getID()
        {
            return $this->id;
        }

        /**
         * Accessor for the name of this regulator
         * @return mixed
         *      the regulator name
         */
        public function getName()
        {
            return $this->name;
        }

        /**
         * Accessor for the amp header for this regulator
         * @return mixed
         *      the amp header
         */
        public function getAmpHeader()
        {
            return $this->amp_header;
        }

        private function buildRegulatorARead(RegulatorRead $regulatorRead)
        {
			echo("<div class='row'>");
			echo("<div class='column-small'>A</div>");
			echo("<div class='column'>".$regulatorRead->getACount()."</div>");
			echo("<div class='column'>".$regulatorRead->getARaise()."</div>");
			echo("<div class='column'>".$regulatorRead->getALower()."</div>");
			echo("<div class='column'>".$regulatorRead->getAAmp()."</div>");
			echo("<div class='column'>".$regulatorRead->getAHighVoltage()."</div>");
			echo("<div class='column'>".$regulatorRead->getALowVoltage()."</div>");
			echo("<div class='column'>".$regulatorRead->getAComments()."</div>");
			echo("</div>");
		}

		private function buildRegulatorBRead(RegulatorRead $regulatorRead)
        {
			echo("<div class='row'>");
			echo("<div class='column-small'>B</div>");
			echo("<div class='column'>".$regulatorRead->getBCount()."</div>");
			echo("<div class='column'>".$regulatorRead->getBRaise()."</div>");
			echo("<div class='column'>".$regulatorRead->getBLower()."</div>");
			echo("<div class='column'>".$regulatorRead->getBAmp()."</div>");
			echo("<div class='column'>".$regulatorRead->getBHighVoltage()."</div>");
			echo("<div class='column'>".$regulatorRead->getBLowVoltage()."</div>");
			echo("<div class='column'>".$regulatorRead->getBComments()."</div>");
			echo("</div>");
		}

		private function buildRegulatorCRead(RegulatorRead $regulatorRead)
        {
            echo("<div class='row-bottom'>");
			echo("<div class='column-small'>C</div>");
			echo("<div class='column'>".$regulatorRead->getCCount()."</div>");
			echo("<div class='column'>".$regulatorRead->getCRaise()."</div>");
			echo("<div class='column'>".$regulatorRead->getCLower()."</div>");
			echo("<div class='column'>".$regulatorRead->getCAmp()."</div>");
			echo("<div class='column'>".$regulatorRead->getCHighVoltage()."</div>");
			echo("<div class='column'>".$regulatorRead->getCLowVoltage()."</div>");
			echo("<div class='column'>".$regulatorRead->getCComments()."</div>");
			echo("</div>");
		}

		private function buildRegulatorHeading()
        {
			echo("<div class='row-top-header'>");
			echo("<div class='column-header-small'>" . $this->name . "</div>");
			echo("<div class='column-header'>Count</div>" );
			echo("<div class='column-header'>Raise</div>" );
			echo("<div class='column-header'>Lower</div>" );
			echo("<div class='column-header'>AMP " . $this->amp_header . "</div>" );
			echo("<div class='column-header'>High Voltage</div>");
			echo("<div class='column-header'>Low Voltage</div>");
			echo("<div class='column-header'>Comments</div>");
			echo("</div>");
		}

		private function buildRegulatorAForms(RegulatorRead $regulatorRead)
        {
			echo("<div class='row'>");
			echo("<div class='column-small'>A</div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "a_count' value='".$regulatorRead->getACount()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "a_raise' value='".$regulatorRead->getARaise()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "a_lower' value='".$regulatorRead->getALower()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "a_amp' value='".$regulatorRead->getAAmp()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "a_high_voltage' value='".$regulatorRead->getAHighVoltage()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "a_low_voltage' value='".$regulatorRead->getALowVoltage()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "a_comments' value='".$regulatorRead->getAComments()."' /></div>");
			echo("</div>");
		}

		private function buildRegulatorBForms(RegulatorRead $regulatorRead)
        {
			echo("<div class='row'>");
			echo("<div class='column-small'>B</div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "b_count' value='".$regulatorRead->getBCount()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "b_raise' value='".$regulatorRead->getBRaise()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "b_lower' value='".$regulatorRead->getBLower()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "b_amp' value='".$regulatorRead->getBAmp()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "b_high_voltage' value='".$regulatorRead->getBHighVoltage()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "b_low_voltage' value='".$regulatorRead->getBLowVoltage()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "b_comments' value='".$regulatorRead->getBComments()."' /></div>");
			echo("</div>");
		}

		private function buildRegulatorCForms(RegulatorRead $regulatorRead)
        {
			echo("<div class='row-bottom'>");
			echo("<div class='column-small'>C</div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "c_count' value='".$regulatorRead->getCCount()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "c_raise' value='".$regulatorRead->getCRaise()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "c_lower' value='".$regulatorRead->getCLower()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "c_amp' value='".$regulatorRead->getCAmp()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "c_high_voltage' value='".$regulatorRead->getCHighVoltage()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "c_low_voltage' value='".$regulatorRead->getCLowVoltage()."' /></div>");
			echo("<div class='column'><input type='text' class='text-box' name='r" . $this->id . "c_comments' value='".$regulatorRead->getCComments()."' /></div>");
			echo("</div>");
		}
	}
?>