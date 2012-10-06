<?php	
	require_once('profileservice.php');	
	require_once('locationservice.php');	
	require_once('chatservice.php');	
	require_once('response.php');
	
	class Dispatcher {
		public function dispatch($url, $method, $getArgs, $postArgs) {
			try {
				$urlParts = parse_url($url);	        
				$pathParts = preg_split('[/]', substr($urlParts['path'], 1));	        	       
				
				if (count($pathParts) < 4) {
					throw new Exception("Invalid request: $url");
				}
				
				$serviceType = $pathParts[2];
				$method = $pathParts[3];
				
				$service = null;
				switch($serviceType) {
					case 'profile':
						$service = new ProfileService();
						break;
					case 'location':
						$service = new LocationService();
						break;
					case 'chat':
						$service = new ChatService();
						break;
					default:
						break;
				}
				
				if ($service == null) {
					throw new Exception("Unable to create service $serviceType.");
				}
				
				$response = new Response();
				$service->response = $response;
				$service->getArgs = $getArgs;
				$service->postArgs = $postArgs;
				
				if ($method != null && method_exists($service, $method)) {
					if ($service->$method()) {
						$service->response->output();
						return true;
					} else {
						die("Error executing $method.");
					}
				} else if ($method == null) {
					die("No method specified.");
				} else {
					die("Method $method not found.");
				}
				return false;
			} catch (Exception $e) {
				echo ('Caught exception: ' . $e->getMessage());
				echo ('<pre>' . $e->getTraceAsString() . '</pre>');	            
			}
	        return false;
		}	
	}
?>