
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chrispizza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$_SESSION["logged_in"] = false;
$_SESSION["customer_id"] = "";


?>
