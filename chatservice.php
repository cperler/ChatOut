<?php
	require_once('profile.php');
	require_once('db.php');
	
	class ChatService {		
		public function publish() {
			$profile = new Profile();
			
			if (!isset($this->getArgs['username'])) {
				throw new Exception("Unable to find parameter 'username'.");
			}
			
			if (!isset($this->getArgs['message'])) {
				throw new Exception("Unable to find parameter 'message'.");
			}
			
			$profile->username = $this->getArgs['username'];
			$profile->load();

			$message = $this->getArgs['message'];
			$profile->publish($message);
			
			$this->response->status = 'ok';
			return true;
		}
		
		public function listen() {
			$profile = new Profile();
			
			if (!isset($this->getArgs['username'])) {
				throw new Exception("Unable to find parameter 'username'.");
			}
			
			$profile->username = $this->getArgs['username'];
			$profile->load();
			
			$this->response->status = 'ok';
			$this->response->chats = $profile->listen();
			return true;
		}
	}
?>