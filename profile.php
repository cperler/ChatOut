<?php
	class Profile
	{
		var $id;
		var $username;
		var $birthdate;
		var $gender;
		
		var $latitude;
		var $longitude;
		var $lastLocationUpdatetime;
		
		var $radiusOfInterestDistance;
		var $radiusOfInterestUnits;
		
		var $gendersOfInterest;
		var $minAgeOfInterest;
		var $maxAgeOfInterest;
		
		public function saveLocation() {
			if (isset($this->id)) {
				if (isset($this->latitude) && isset($this->longitude)) {
					DB::exec("update profile set latitude = $this->latitude, longitude = $this->longitude, last_location_updatetime = now() where id = $this->id");
				}
			}
		}
		
		public function publish($message) {
			if (isset($this->id) && isset($this->latitude) && isset($this->longitude)) {
				DB::exec("insert chat (profile_id, latitude, longitude, message, broadcast_datetime) " .
						 "values ($this->id, $this->latitude, $this->longitude, '$message', now())");
			}
		}
		
		public function listen() {
			if (isset($this->id) && isset($this->latitude) && isset($this->longitude)) {			
						
			/*return DB::exec("select l.latitude lat, l.longitude lon, (((acos(sin(($this->lat*pi()/180)) ".
			"* sin((l.latitude*pi()/180)) " .
 			"+ cos(($this->lat*pi()/180)) * cos((l.latitude*pi()/180)) ".
 			"* cos((($this->lon - l.longitude)*pi()/180))))*180/pi())*60*1.1515) ".
			"as distance from location l, ident i ".			
			"where i.gender = '$gender' " .
			"and i.age >= $minAge " .
			"and i.age <= $maxAge " .
			"and i.id = l.id " .
			"and l.id != $this->id " .
			"having distance <= $distance ".
			"and distance >= 0 " .
			"order by distance asc");*/
						
				return DB::exec("select p.username, c.* from profile p, chat c where p.id = c.profile_id order by c.broadcast_datetime asc");
			}
			return null;
		}
		
		public function update() {
			if (isset($this->id)) {
				DB::exec("update profile set " .
					"gender = '$this->gender', " .
					"birthdate = '$this->birthdate', " .
					"radius_of_interest_distance = $this->radiusOfInterestDistance, " .
					"radius_of_interest_units = '$this->radiusOfInterestUnits', " .
					"genders_of_interest = '$this->gendersOfInterest', " .
					"min_age_of_interest = $this->minAgeOfInterest, " .					
					"max_age_of_interest = $this->maxAgeOfInterest " .
					"where id = $this->id");
			}
		}
		
		public function load() {
			if (isset($this->username)) {
				$results = DB::exec("select * from profile where username = '$this->username'");
				if (count($results) == 1) {
					$copyFrom = $results[0];
					$this->id = $copyFrom['id'];
					$this->gender = $copyFrom['gender'];
					$this->birthdate = $copyFrom['birthdate'];
					
					$this->latitude = $copyFrom['latitude'];
					$this->longitude = $copyFrom['longitude'];
					$this->lastLocationUpdatetime = $copyFrom['last_location_updatetime'];
					
					$this->radiusOfInterestDistance = $copyFrom['radius_of_interest_distance'];
					$this->radiusOfInterestUnits = $copyFrom['radius_of_interest_units'];
		
					$this->gendersOfInterest = $copyFrom['genders_of_interest'];
					$this->minAgeOfInterest = $copyFrom['min_age_of_interest'];
					$this->maxAgeOfInterest = $copyFrom['max_age_of_interest'];
					return;
				}
			}

			throw new Exception("Profile for $this->username was not found.");
		}
	}
?>