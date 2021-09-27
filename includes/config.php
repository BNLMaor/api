<?php

   // Database Configuration
  $dbinfo = array(
    "host" => 'localhost',        // Your mySQL Host (usually Localhost)
    "db" => 'bnlstudi_apiclient',            // The database where you have dumped the included sql file
    "user" => 'bnlstudi_apiclient',        // Your mySQL username
    "password" => ',f&TQ%ZS!0!{',    //  Your mySQL Password 
    "prefix" => ''      // Prefix for your tables if you are using same db for multiple scripts, e.g. short_
  );

  $config = array(
    "timezone" => date_default_timezone_get(),
    "debug" => 1

  );
  
  include ("core.php");

?>