<?php

    include_once ("Breaker.php");

    /**
     * Model class for a breaker reading
     */
    class BreakerRead {

        private $read;
        private $breaker_read_id;
        private $read_id;
        private $breaker_id;
        private $read_date;
        private $count;
        private $a_flag;
        private $b_flag;
        private $c_flag;
        private $n_flag;
        private $battery;
        private $a_amps;
        private $b_amps;
        private $c_amps;
        private $a_mult;
        private $b_mult;
        private $c_mult;
        private $comments;

        /**
         * Constructor for breaker reading class
         * @param Breaker $breaker
         *      The breaker this reading was taken from
         * @param $date
         *      The date this reading was taken
         */
        public function __construct(Breaker $breaker, $date)
        {
            $this->breaker_id = $breaker->getID();
            $this->read = $this->getBreakerRead($date);
            $this->breaker_read_id = $this->read['breaker_read_id'];
            $this->read_id = $this->read['read_id'];
            $this->read_date = $this->read['read_date'];
            $this->count = $this->read['count'];
            $this->a_flag = $this->read['a_flag'];
            $this->b_flag = $this->read['b_flag'];
            $this->c_flag = $this->read['c_flag'];
            $this->n_flag = $this->read['n_flag'];
            $this->battery = $this->read['battery'];
            $this->a_amps = $this->read['a_amps'];
            $this->b_amps = $this->read['b_amps'];
            $this->c_amps = $this->read['c_amps'];
            $this->a_mult = $this->read['a_mult'];
            $this->b_mult = $this->read['b_mult'];
            $this->c_mult = $this->read['c_mult'];
            $this->comments = $this->read['comments'];
        }

        /**
         * Get the requested breaker reading from the DB via date
         * @param $date
         *      the date of the requested reading
         * @return array
         *      raw sql response
         */
        public function getBreakerRead($date)
        {
            include_once('../query/dbconnect.php');
            //TODO: mysqli would be more appropriate & secure
            $query = mysql_query("
				SELECT     *
				FROM       `station_breaker_read`
				WHERE      `breaker_id` = '$this->breaker_id'     AND
				           `read_date` = '$date';
			");
            return $row = mysql_fetch_assoc($query);
        }

        /**
         * if the reading already exists, this will update the existing breaker
         * reading, if the reading does not exist, this will create a new reading
         */
        public function submitBreakerRead()
        {
            if ($this->breaker_read_id != null)
            {
                $this->updateBreakerRead();
                echo("UPDATED EXISTING BREAKER READ");
                echo($this->read_id);
            } else
            {
                $this->insertBreakerRead();
                echo("INSERTED NEW BREAKER READ");
            }
        }

        private function insertBreakerRead()
        {
            $query = "
                INSERT     INTO     `station_reads`.`station_breaker_read` (
                                    `read_id`, `breaker_id`, `read_date`, `count`, `a_flag`, `b_flag`,
                                    `c_flag`, `n_flag`, `battery`, `a_amps`, 
                                    `b_amps`, `c_amps`, `a_mult`, `b_mult`, 
                                    `c_mult`, `comments`) 
                VALUES ('".$this->read_id ."', '".$this->breaker_id ."', '" . $this->read_date . "', '".$this->count."',
                        '".$this->a_flag."', '".$this->b_flag."', '".$this->c_flag."',
                        '".$this->n_flag."', '".$this->battery."', '".$this->a_amps."',
                        '".$this->b_amps."', '".$this->c_amps."', '".$this->a_mult."',
                        '".$this->b_mult."', '".$this->c_mult."', '".$this->comments."');
			";
            if (!mysql_query($query))
            {
                die('Error: ' . mysql_error());
            }
            echo "1 record added";
        }

        private function updateBreakerRead()
        {
            $query = mysql_query("
                UPDATE  `station_reads`.`station_breaker_read`
                SET     `read_date`='$this->read_date', `count`='$this->count', `a_flag`='$this->a_flag',
                        `b_flag`='$this->b_flag', `c_flag`='$this->c_flag', `n_flag`='$this->n_flag',
                        `battery`='$this->battery', `a_amps`='$this->a_amps', `b_amps`='$this->b_amps',
                        `c_amps`='$this->c_amps', `a_mult`='$this->a_mult', `b_mult`='$this->b_mult',
                        `c_mult`='$this->c_mult', `comments`='$this->comments'
                WHERE `breaker_read_id`='$this->breaker_read_id';
            ");
            return $query;
        }

        /**
         * Mutator for breaker_read_id
         * @param mixed $breaker_read_id
         *      the new value of breaker_read_id
         */
        public function setBreakerReadId($breaker_read_id)
        {
            $this->breaker_read_id = $breaker_read_id;
        }

        /**
         * Accessor for breaker_read_id
         * @return mixed
         *      the value of breaker_read_id
         */
        public function getBreakerReadId()
        {
            return $this->breaker_read_id;
        }

        /**
         * Mutator for a_amps
         * @param mixed $a_amps
         *      the new value of a_amps
         */
        public function setAAmps($a_amps)
        {
            $this->a_amps = $a_amps;
        }

        /**
         * Accessor for a_amps
         * @return mixed
         *      the value of a_amps
         */
        public function getAAmps()
        {
            return $this->a_amps;
        }

        /**
         * Mutator for a_flag
         * @param mixed $a_flag
         *      The new value for a_flag
         */
        public function setAFlag($a_flag)
        {
            $this->a_flag = $a_flag;
        }

        /**
         * Accessor for a_flag
         * @return mixed
         *      the value of a_flag
         */
        public function getAFlag()
        {
            return $this->a_flag;
        }

        /**
         * Mutator for a_mult
         * @param mixed $a_mult
         *      the new value of a_mult
         */
        public function setAMult($a_mult)
        {
            $this->a_mult = $a_mult;
        }

        /**Accessor for a_mult
         * @return mixed
         *      the value of a_mult
         */
        public function getAMult()
        {
            return $this->a_mult;
        }

        /**
         * Mutator for b_amps
         * @param mixed $b_amps
         *      the new value for b_amps
         */
        public function setBAmps($b_amps)
        {
            $this->b_amps = $b_amps;
        }

        /**
         * Accessor for b_amps
         * @return mixed
         *      the value of b_amps
         */
        public function getBAmps()
        {
            return $this->b_amps;
        }

        /**
         * Mutator for b_flag
         * @param mixed $b_flag
         *      the new value of b_flag
         */
        public function setBFlag($b_flag)
        {
            $this->b_flag = $b_flag;
        }

        /**
         * Accessor for b_flag
         * @return mixed
         *      the value of b_flag
         */
        public function getBFlag()
        {
            return $this->b_flag;
        }

        /**
         * Mutator for b_mult
         * @param mixed $b_mult
         *      the new value for b_mult
         */
        public function setBMult($b_mult)
        {
            $this->b_mult = $b_mult;
        }

        /**
         * Accessor for b_mult
         * @return mixed
         *      the value of b_mult
         */
        public function getBMult()
        {
            return $this->b_mult;
        }

        /**
         * Mutator for battery
         * @param mixed $battery
         *      the new value of battery
         */
        public function setBattery($battery)
        {
            $this->battery = $battery;
        }

        /**
         * Accessor for battery
         * @return mixed
         *      the value of battery
         */
        public function getBattery()
        {
            return $this->battery;
        }

        /**
         * Mutator for breaker_id
         * @param mixed $breaker_id
         *      the new value of $breaker_id
         */
        public function setBreakerId($breaker_id)
        {
            $this->breaker_id = $breaker_id;
        }

        /**
         * Accessor for breaker_id
         * @return mixed
         *      the value of breaker_id
         */
        public function getBreakerId()
        {
            return $this->breaker_id;
        }

        /**
         * Mutator for c_amps
         * @param mixed $c_amps
         *      the new value of c_amps
         */
        public function setCAmps($c_amps)
        {
            $this->c_amps = $c_amps;
        }

        /**
         * Accessor for c_amps
         * @return mixed
         *      the value of c_amps
         */
        public function getCAmps()
        {
            return $this->c_amps;
        }

        /**
         * Mutator for c_flag
         * @param mixed $c_flag
         *      the new value of c_flag
         */
        public function setCFlag($c_flag)
        {
            $this->c_flag = $c_flag;
        }

        /**
         * Accessor for c_flag
         * @return mixed
         *      the value of c_flag
         */
        public function getCFlag()
        {
            return $this->c_flag;
        }

        /**
         * Mutator for c_mult
         * @param mixed $c_mult
         *      the new value of c_mult
         */
        public function setCMult($c_mult)
        {
            $this->c_mult = $c_mult;
        }

        /**
         * Accessor for c_mult
         * @return mixed
         *      the value of c_mult
         */
        public function getCMult()
        {
            return $this->c_mult;
        }

        /**
         * Mutator for comments
         * @param mixed $comments
         *      the new value of comments
         */
        public function setComments($comments)
        {
            $this->comments = $comments;
        }

        /**
         * Accessor for comments
         * @return mixed
         *      the value of comments
         */
        public function getComments()
        {
            return $this->comments;
        }

        /**
         * Mutator for count
         * @param mixed $count
         *      the new value of count
         */
        public function setCount($count)
        {
            $this->count = $count;
        }

        /**
         * Accessor for count
         * @return mixed
         *      the value of count
         */
        public function getCount()
        {
            return $this->count;
        }

        /**
         * Mutator for n_flag
         * @param mixed $n_flag
         *      the new value of n_flag
         */
        public function setNFlag($n_flag)
        {
            $this->n_flag = $n_flag;
        }

        /**
         * Accessor for n_flag
         * @return mixed
         *      the value of n_flag
         */
        public function getNFlag()
        {
            return $this->n_flag;
        }

        /**
         * Mutator for read
         * @param array $read
         *      the new value of read
         */
        public function setRead($read)
        {
            $this->read = $read;
        }

        /**
         * Accessor for read
         * @return array
         *      the current read array
         */
        public function getRead()
        {
            return $this->read;
        }

        /**
         * Mutator for read_date
         * @param mixed $read_date
         *      the new value of read_date
         */
        public function setReadDate($read_date)
        {
            $this->read_date = $read_date;
        }

        /**
         * Accessor for read_date
         * @return mixed
         *      the value of read_date
         */
        public function getReadDate()
        {
            return $this->read_date;
        }

        /**
         * Mutator for read_id
         * @param mixed $read_id
         *      the new value of read_id
         */
        public function setReadId($read_id)
        {
            $this->read_id = $read_id;
        }

        /**
         * Accessor for read_id
         * @return mixed
         *      the value of read_id
         */
        public function getReadId()
        {
            return $this->read_id;
        }

    }

?>