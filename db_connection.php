<?php

// ====================================================================================
$serverName = "ICEP-SERVER\\SQLEXPRESS";

// Since UID and PWD are not specified in the $connectionInfo array,
// The connection will be attempted using Windows Authentication.
$connectionInfo = array( 
    "Database"=>"Kadry2024v2", 
    "UID"=>"Kadry2023", 
    "PWD"=>"Kadry2023", 
    "CharacterSet" => "UTF-8",
    "ReturnDatesAsStrings"=>true);
$conn = sqlsrv_connect( $serverName, $connectionInfo);

// ====================================================================================