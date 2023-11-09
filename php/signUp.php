
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


// $signupName = $_POST['signup-name'];
// $signupEmail = $_POST['signup-email'];
// $signupPassword = $_POST['signup-password'];
// $signupPasswordEncrypt = md5($signupPassword);
// $signupAddress = $_POST['signup-address'];
// $signupContact = $_POST['signup-contact'];

// //check if account exists or not 
// $sql = "SELECT * FROM customers WHERE email='$signupEmail'";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   echo 'Account already exists';
// } else {
//   $sql = "";
// }

$signupName = $_POST['signup-name'];
$signupEmail = $_POST['signup-email'];
$signupPassword = $_POST['signup-password'];
$signupPasswordEncrypt = password_hash($signupPassword, PASSWORD_DEFAULT); // Use a more secure hashing algorithm
$signupAddress = $_POST['signup-address'];
$signupContact = $_POST['signup-contact'];

// Check if account exists or not
$sqlCheck = "SELECT * FROM customers WHERE email=?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("s", $signupEmail);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
  echo 'Account already exists';
} else {
  // Insert new account
  $sqlInsert = "INSERT INTO customers (name, password, email, address, contact, type, orders) VALUES (?, ?, ?, ?, ?, 'member', NULL)";
  $stmtInsert = $conn->prepare($sqlInsert);
  $stmtInsert->bind_param("sssss", $signupName, $signupPasswordEncrypt, $signupEmail, $signupAddress, $signupContact);

  if ($stmtInsert->execute()) {
    echo 'Account created successfully';
    $sql = "SELECT * FROM customers WHERE email= '$signupEmail'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $_SESSION['customer_id'] = $row['customer_id'];
      $_SESSION['logged_in'] = true;
    }
  } else {
    echo 'Error creating account, please try again later';
    $_SESSION['logged_in'] = false;
  }
}
?>
