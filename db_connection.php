<?php


// FS
$host = 'localhost'; 
$username = 'root'; 
$password = ''; 
$dbname = 'library_access_db'; 

$conn = mysqli_connect($host, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
