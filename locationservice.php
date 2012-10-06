<?php
	require_once('profile.php');
	require_once('db.php');
	
	class LocationService {		
		public function update() {
			$profile = new Profile();
			
			if (!isset($this->getArgs['username'])) {
				throw new Exception("Unable to find parameter 'username'.");
			}
			
			if (!isset($this->getArgs['latitude'])) {
				throw new Exception("Unable to find parameter 'latitude'.");
			}
			
			if (!isset($this->getArgs['longitude'])) {
				throw new Exception("Unable to find parameters 'longitude'.");
			}
			
			$profile->username = $this->getArgs['username'];
			$profile->load();
			
			$profile->latitude = $this->getArgs['latitude'];
			$profile->longitude = $this->getArgs['longitude'];
			$profile->saveLocation();
			
			$this->response->status = 'ok';
			return true;
		}
	}
?>