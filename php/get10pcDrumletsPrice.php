<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chrispizza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT itemprice FROM menu WHERE name = '10pc Drumlets'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $hawaiianPrice = $row["itemprice"];
  echo "$" . $hawaiianPrice . "";
} else {
  echo "Not avaliable";
  $hawaiianPrice = "Not avaliable";
}

$conn->close();
?>
