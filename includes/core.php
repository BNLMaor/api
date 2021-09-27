<?php
	session_start();
	define("APP", 1);
	define("ROOT",dirname(dirname(__FILE__)));
	
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/
	
	include("class_lib.php");
	$url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$furl = "https://spotikey.com/";
	
    // Defines Template
	define("TEMPLATE",ROOT."/sources/views/");
	
	// Defines Template
	//define("TEMPLATE",ROOT."/sources/views/");
	
	// Connect to database
	include("Database.class.php");	
	$db = new Database($config, $dbinfo);
	



?>