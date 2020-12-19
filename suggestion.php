<?php
//database configuration
$dbHost = 'localhost';
$dbUsername = 'downbqfu_db';
$dbPassword = 'Toolsmashdb420';
$dbName = 'downbqfu_nsuer';

//connect with the database
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

//get search term
$searchTerm = $_GET['term'];

//get matched data from skills table

/*
    $query = $db->query("SELECT * FROM sites ORDER BY course ASC");
    while ($row = $query->fetch_assoc()) {
        echo '\',\''.$row['course'];
    }


die();
*/


$query = $db->query("SELECT * FROM sites WHERE course LIKE '%" . $searchTerm . "%' ORDER BY course ASC");
while ($row = $query->fetch_assoc()) {
    $data[] = $row['course'];
}

//return json data
echo json_encode($data);
?>