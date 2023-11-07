
<?php
session_start();

if (isset($_POST['index']) && isset($_POST['remove'])) {
  $index = $_POST['index'];

  if (isset($_SESSION['cart'][$index])) {
    // Remove the item at the specified index
    unset($_SESSION['cart'][$index]);

    // Re-index the array to remove gaps
    $_SESSION['cart'] = array_values($_SESSION['cart']);

    // Redirect back to the cart page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    // header('location: ../pizza.php');
    // header("location:javascript://history.go(-1)");
    exit;
  }
}
?>
