<?php
session_start();
var_dump($_SESSION);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chrispizza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$orderId = $_SESSION['currentOrderId'];
$customerId = $_SESSION['customer_id'];
$rating = $_POST['rating'];
$feedbackComment = $_POST['feedback-comment'];


if ($orderId !== null && $customerId !== null && $rating !== null && $feedbackComment !== null) {
  // All variables are not null, proceed with the SQL query
  $sql = "INSERT INTO feedback (order_id, customer_id, rating, comments) VALUES ('$orderId', '$customerId', '$rating', '$feedbackComment')";
  $result = $conn->query($sql);

  if ($result) {
    // SQL query executed successfully
    echo "Insertion successful!";
    $_SESSION['feedback'] = true;
  } else {
    // Handle any errors that may occur during the query execution
    echo "Error: " . $conn->error;
    $_SESSION['feedback'] = false;
  }
} else {
  // Handle the case where any of the variables is null
  echo "One or more required variables are missing or null.";
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
?>