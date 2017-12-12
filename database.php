<?php

function getDatabaseConnection()
{
    // $host = "localhost";
    // $username = "wesmixon";
    // $password = "qwer1234";
    // $dbname="tech_devices_app";
    
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "be38fd891d40b6";
    $password = "40d33621";
    $dbname = "heroku_e2089215ec11dea";

// Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $conn;
    
  }
  
function departmentList() {
      
        global $conn;
        
        $sql = "SELECT * FROM Departments ORDER BY name";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $records;
}

?>