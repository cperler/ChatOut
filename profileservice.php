<?php
	require_once('profile.php');
	require_once('db.php');
	
	class ProfileService {		
		public function get() {
			$profile = new Profile();
			
			if (!isset($this->getArgs['username'])) {
				throw new Exception("Unable to find parameter 'username'.");
			}
			
			$profile->username = $this->getArgs['username'];
			$profile->load();
			
			$this->response->status = 'ok';
			$this->response->profile = $profile;
			return true;
		}
		
		public function update() {
			$profile = new Profile();
			
			if (!isset($this->getArgs['username'])) {
				throw new Exception("Unable to find parameter 'username'.");
			}
			
			$profile->username = $this->getArgs['username'];
			$profile->load();			
			$profile->update();
			
			$this->response->status = 'ok';
			$this->response->profile = $profile;
			return true;
		}
	}
?>