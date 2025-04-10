<?php
$servername = 'localhost';
$username = 'root';
$pwd = '';
$db = 'fooddb';

$conn = new mysqli($servername, $username, $pwd, $db, 3307);

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>