<?php
$servername = "localhost";
$username = "Faty"; 
$password = "20052005"; 
$dbname = "ClassDB";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
