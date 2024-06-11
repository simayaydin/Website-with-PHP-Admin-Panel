<?php 

session_start(); //--we started session--

//--to display PHP errors--
ini_set('display_errors', '1'); // 1 is on, 0 is off
ini_set('display_startup_errors', '1'); // 1 is on, 0 is off
error_reporting(E_ALL);


//--query function--
function berkhoca_query_parser($sql='') {

    //--to connect database--
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "berkhoca_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(empty($sql)) {
        return 'SQL statement is empty';
    }
    $query_result = $conn->query($sql);

    // Check if query was successful
    if($query_result === false) {
        return 'Query execution failed: ' . $conn->error;
    }

    // Return the result of the query execution
    return $query_result;
}






?>



