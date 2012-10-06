<?php
	require_once('dispatcher.php');	
	
	$dispatcher = new Dispatcher();	
	$url = $_SERVER['REQUEST_URI'];
	$method = $_SERVER['REQUEST_METHOD'];
	$getArgs = $_GET;
	$postArgs = $_POST;
	
	if (isset($url)) {
		$dispatcher->dispatch($url, $method, $getArgs, $postArgs);
	}
?>