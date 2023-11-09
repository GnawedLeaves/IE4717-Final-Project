
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




$signinEmail = $_POST['signin-email'];
$signinPassword = $_POST['signin-password'];
$encryptedSigninPassword = password_hash($signinPassword, PASSWORD_DEFAULT);

// echo $signinEmail;
// echo $signinPassword;
$sql = "SELECT * FROM customers WHERE email= '$signinEmail'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($signinEmail === $row['email']) {
    if (password_verify($signinPassword, $row['password'])) {
      $_SESSION['customer_id'] = $row['customer_id'];
      $_SESSION['logged_in'] = true;
      echo 'Log in successful!';
    } else {
      $_SESSION['logged_in'] = false;
      $_SESSION['customer_id'] = "";
      echo 'Wrong password';
    }
  } else {
    $_SESSION['logged_in'] = false;
    $_SESSION['customer_id'] = "";
    echo 'Email not registered';
  }

} else {
  $_SESSION['logged_in'] = false;
  $_SESSION['customer_id'] = "";
  echo 'Email not registered';
}



?>
