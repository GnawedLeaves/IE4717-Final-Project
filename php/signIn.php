
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


if (isset($_POST['signin-submit'])) {
  $signinEmail = $_POST['signin-email'];
  $signinPassword = $_POST['signin-password'];

  $sql = "SELECT * FROM customers WHERE email='$signinEmail' AND password='$signinPassword'";

  header('Location: ' . $_SERVER['HTTP_REFERER']);
  exit;
}


?>
