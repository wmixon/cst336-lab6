<?php

function getDatabaseConnection()
{
    // $host = "localhost";
    // $username = "wesmixon";
    // $password = "qwer1234";
    // $dbname="tech_devices_app";
    
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "bdb5384f6f52f0";
    $password = "caeb83fc";
    $dbname = "heroku_e85b7747a279cb7";

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