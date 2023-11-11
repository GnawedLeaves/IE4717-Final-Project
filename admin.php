<?php
session_start();
// error_reporting(E_ERROR | E_PARSE);
// var_dump($_SESSION);

if (!isset($_SESSION["cart"])) {
  $_SESSION['cart'] = array();
}

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "chrispizza";

// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//   // Validate user input
//   foreach ($_POST['itemprice'] as $itemid => $price) {
//     $price = floatval($price);
//     if ($price < 0) {
//       echo "Prices must be non-negative numbers.";
//       exit;
//     }

//     // Update the database
//     $updateQuery = "UPDATE menu SET itemprice = $price WHERE itemid = $itemid";

//     if ($conn->query($updateQuery) !== TRUE) {
//       echo "Error updating prices: " . $conn->error;
//       exit;
//     }
//   }

//   echo "Prices updated successfully!";
// }

// // Fetch current menu items from the database
// $query = "SELECT * FROM menu";
// $result = $conn->query($query);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Galada&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="icon" href="./assets/images/favicon/favicon.ico" type="image/x-icon"/>
    <title>Chris' Pizza</title>
    <style></style>
  </head>
  <body>


    <div class="navbar">
      <a href="index.php">
        <div class="navbar-logo-container">
          <div class="navbar-logo-title">Chris' Pizza</div>
          <img class="navbar-logo" src="./assets/images/icon.png" />
        </div>
      </a>

      <div class="sub-navbar">
        <div class="navbarItems">
          <a href="#" class="navbarItem">Menu</a>
          <a href="#" class="navbarItem">Offers</a>
          <a href="allorders.php" class="navbarItem">Your Orders</a>
          <a href="stores.php" class="navbarItem">Stores</a>
          <a href="#" class="navbarItem">Support</a>
        </div>


      </div>


    </div>

      <div class="container">
      <div class="page-title-container">
        <div class="page-title">Admin </div>
      </div>
      <div class="edit-container">
    <form method="post" action="" class="update-prices-form">
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "chrispizza";

      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        foreach ($_POST['itemprice'] as $itemid => $price) {
          $price = floatval($price);
          if ($price < 0) {
            echo "Prices must be non-negative numbers.";
            exit;
          }


          $updateQuery = "UPDATE menu SET itemprice = $price WHERE itemid = $itemid";

          if ($conn->query($updateQuery) !== TRUE) {
            echo "Error updating prices: " . $conn->error;
            exit;
          }
        }

        echo "<div style='font-weight: bold; color: red;'></div>Prices updated successfully!";
      }


      $query = "SELECT * FROM menu";
      $result = $conn->query($query);
      ?>
        <table border="1">
            <tr>
                <th>Item ID</th>
                <th>Name</th>
                <th>Current Price</th>
                <th>New Price</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>{$row['itemid']}</td>";
              echo "<td>{$row['name']} ({$row['size']})</td>";
              echo "<td>\${$row['itemprice']}</td>";
              echo "<td><input type='number' step='0.01' name='itemprice[{$row['itemid']}]' value='{$row['itemprice']}' required></td>";
              echo "</tr>";
            }
            ?>
        </table>

        <button type="submit">Update Prices</button>
    </form>
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chrispizza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $allowedStatus = ["In the kitchen", "On the way", "Completed"];

  foreach ($_POST['status'] as $orderId => $status) {
    if (!in_array($status, $allowedStatus)) {
      echo "Invalid status selected.";
      exit;
    }


    $updateQuery = "UPDATE ordersummary SET status = '$status' WHERE id = $orderId";

    if ($conn->query($updateQuery) !== TRUE) {
      echo "Error updating status: " . $conn->error;
      exit;
    }
  }

  echo "<div style='font-weight: bold; color: red;'></div>Status updated successfully!";
}


$query = "SELECT * FROM ordersummary ORDER BY id DESC";
$result = $conn->query($query);
?>
    <form method="post" action="">
        <table border="1">
            <tr>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Total</th>
                <th>Date</th>
                <th>Delivery Time</th>
                <th>Status</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>{$row['order_id']}</td>";
              echo "<td>{$row['customer_id']}</td>";
              echo "<td>\${$row['total']}</td>";
              echo "<td>{$row['date']}</td>";
              echo "<td>{$row['delivery_time']}</td>";
              echo "<td>
                        <select name='status[{$row['id']}]'>
                            <option value='In the kitchen' " . ($row['status'] == 'In the kitchen' ? 'selected' : '') . ">In the kitchen</option>
                            <option value='On the way' " . ($row['status'] == 'On the way' ? 'selected' : '') . ">On the way</option>
                            <option value='Completed' " . ($row['status'] == 'Completed' ? 'selected' : '') . ">Completed</option>
                        </select>
                    </td>";
              echo "</tr>";
            }
            ?>
        </table>

        <button type="submit">Update Status</button>
    </form>

      </div>
        <div class="footer">
          <div class="footer-left-container">
            <div class="footer-info-container">
              <img class="footer-img" src="./assets/images/footer-icon.png" />
              <div class="footer-left-text-container">
                <div class="footer-title">Chris' Pizza</div>
                <div class="footer-subtitle">Pizza House SG Pte Ltd</div>
                <div class="footer-number">6723 9873</div>
              </div>
            </div>
          </div>
          <div class="footer-right-container">
            <div class="footer-links-container">
              <div class="footer-links-title">Menu</div>
              <div class="footer-links-content-container">
                <a class="footer-link" href="#">Pizza</a>
                <a class="footer-link" href="#">Sides</a>
                <a class="footer-link" href="#">Drinks</a>
                <a class="footer-link" href="#">Sweet Treats</a>
              </div>
            </div>
            <div class="footer-links-container">
              <div class="footer-links-title">Offers</div>
              <div class="footer-links-content-container">
                <a class="footer-link" href="#">Hot Offers</a>
                <a class="footer-link" href="#">Sharing Bundles</a>
              </div>
            </div>
            <div class="footer-links-container">
              <div class="footer-links-title">Company</div>
              <div class="footer-links-content-container">
                <a class="footer-link" href="#">Join Us</a>
                <a class="footer-link" href="#">About Us</a>
                <a class="footer-link" href="#">Terms of Use</a>
                <a class="footer-link" href="#">Privacy Policy</a>
                <a class="footer-link" href="#">Stores</a>
              </div>
            </div>
            <div class="footer-links-container">
              <div class="footer-links-title">Support</div>
              <div class="footer-links-content-container">
                <a class="footer-link" href="#">FAQs</a>
                <a class="footer-link" href="#">Contact Us</a>
              </div>
            </div>
            <div class="footer-links-container">
              <div class="footer-links-title">Follow Us</div>
              <div class="footer-links-content-container">
                <div class="footer-link-with-image-container">
                  <i class="fa-brands fa-facebook"></i>
                  <a class="footer-link" href="#">Facebook</a>
                </div>
                <div class="footer-link-with-image-container">
                  <i class="fa-brands fa-instagram"></i>
                  <a class="footer-link" href="#">Instagram</a>
                </div>
                <div class="footer-link-with-image-container">
                  <i class="fa-brands fa-tiktok"></i>
                  <a class="footer-link" href="#">Tik Tok</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- <i class="nav-icon fa-solid fa-cart-shopping fa-xl"></i> -->
      <script>
        function openDialog(id) {
          const dialog = document.getElementById(id);
          dialog.showModal();
        }

        function closeDialog(id) {
          const dialog = document.getElementById(id);
          dialog.close();
        }

        let signupButton = document.getElementById("dialog-signup-button");
        let signinButton = document.getElementById("dialog-signin-button");
        let signUpPage = true;

        function swapDialogContent() {
          if (signUpPage) {
            document.getElementById("signupDialog").style.display = "none";
            document.getElementById("signinDialog").style.display = "flex";
            signUpPage = false;
          } else {
            document.getElementById("signupDialog").style.display = "flex";
            document.getElementById("signinDialog").style.display = "none";
            signUpPage = true;
          }
        }
        function changePage(url) {
          window.location.href = url;
        }

       

                //CART FUNCTIONS
                function cleanUpStringToFloat(input) {
  return parseFloat(input.replace(/[^\d.]/g, ""));
}
                let cart = document.getElementById("cart");
        function showCart() {
         
          cart.style.transform = "translate(0%, -50%)";
        }

        function hideCart() {
          
          cart.style.transform = "translate(100%, -50%)";
        }
        getCartTotal();
function getCartTotal() {
  let cartTotal = 0;
  let subtotalElements = document.getElementsByClassName("cart-order-subtotal");
  Array.from(subtotalElements).forEach((element) => {
  
    cartTotal += cleanUpStringToFloat(element.innerHTML);
  });
 

  cartTotal += cartTotal * 0.1;
  document.getElementById("servicefee-title").innerHTML =
    "$" + (cartTotal * 0.1).toFixed(2);
  cartTotal += 3.9;
  document.getElementById("cart-grand-total-title-price").innerHTML =
    "$" + cartTotal.toFixed(2);
}



//Sign In/ Sign Up Functions

function submitSigninForm() {
    // Get form data
    var formData = new FormData(document.getElementById('signinDialog'));

    if (testSignUpEmail(document.getElementById('signin-email').value)){
      fetch('./php/signIn.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Handle the response
       
        console.log(data);
        if (data.includes('successful')) {
          setTimeout(function () {
                closeDialog('sign-up-dialog');
                location.reload();
            }, 1000);
          document.getElementById('signin-password').style.border = "1px solid black";
          document.getElementById('signin-error-password').innerHTML = data;
        }
        else if (data.includes('Email')) {
          document.getElementById('signin-error-email').innerHTML = data;
          document.getElementById('signin-email').style.border = "1px solid red";
          document.getElementById('signin-error-password').innerHTML = "";
          document.getElementById('signin-password').style.border = "1px solid black";
        }
        else if (data.includes('password')) {
          document.getElementById('signin-error-password').innerHTML = data;
          document.getElementById('signin-password').style.border = "1px solid red";
          document.getElementById('signin-password').value = "";
          document.getElementById('signin-email').style.border = "1px solid black";
          document.getElementById('signin-error-email').innerHTML = "";
        }
         
    })
    .catch(error => {
        console.error('Error:', error);
    });
    }else{
      document.getElementById('signin-error-email').innerHTML = "Please enter a valid email";
      document.getElementById('signin-email').style.border = "1px solid red";
    }
    // Use the Fetch API to send a POST request to the server
   
}


function submitSignupForm() {
    // Get form data
    var formData = new FormData(document.getElementById('signupDialog'));
    if (signUpFormSubmit()){
 // Use the Fetch API to send a POST request to the server
 fetch('./php/signUp.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Handle the response
        document.getElementById('signup-error').innerHTML = data;

        console.log(data);
        if (data.includes('successfully')) {
          setTimeout(function () {
            location.reload();
            closeDialog('sign-up-dialog');
        
            }, 1000);
      
        }

         
    })
    .catch(error => {
        console.error('Error:', error);
    });
    }

   
}


function logout() {
    // Get form data
    var formData = new FormData(document.getElementById('signupDialog'));

    // Use the Fetch API to send a POST request to the server
    fetch('./php/logout.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Handle the response
        location.reload();
        
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



function testSignUpName(name) {
  var namePattern = /^[a-zA-Z\s'-]{3,}$/;  // (alphabets, spaces, ', and -) with a minimum of 3 characters
    return namePattern.test(name);
}

function testSignUpEmail(email) {
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; // (alphabets, numbers,._%+-) @ (alphabets, numbers, -.) .(alphabets of minimum 2 characters)
    return emailPattern.test(email);
}

function testSignUpAddress(address) {
    var addressPattern = /^[a-zA-Z0-9\s,-]+(?:#\d{2,3}-\d{2,3})?$/; // (alphabets, numbers, spaces, ,, and -) optional(#, 2 or 3 digits, -, 2 or 3 digits)
    return addressPattern.test(address);
}

function signUpFormSubmit () {

  let allInputsValid = false;
  let signUpNameInput = document.getElementById('signup-name').value;
  let signUpEmailInput = document.getElementById('signup-email').value;
  let signUpAddressInput = document.getElementById('signup-address').value;

  let signUpNameError = document.getElementById('signup-name-error');
  let signUpEmailError = document.getElementById('signup-email-error');
  let signUpAddressError = document.getElementById('signup-address-error');
  console.log("signUpAddressError",signUpAddressError)

  if (testSignUpName(signUpNameInput)){
    signUpNameError.innerHTML = "";
    signUpNameError.style.display = "none";
    console.log("testSignUpName(signUpNameInput)",testSignUpName(signUpNameInput));
    allInputsValid = true;
  } else {
    signUpNameError.innerHTML = "Please enter a valid name <br/> (< 3 letters, no numbers)";
    signUpNameError.style.display = "block";
    console.log("testSignUpName(signUpNameInput)",testSignUpName(signUpNameInput));
    allInputsValid = false;
  }

  if (testSignUpEmail(signUpEmailInput)){
    signUpEmailError.innerHTML = "";
    signUpEmailError.style.display = "none";
    console.log("testSignUpEmail(signUpEmailInput)",testSignUpEmail(signUpEmailInput));
    allInputsValid = true;
  } else {
    signUpEmailError.innerHTML = "Please enter a valid email";
    signUpEmailError.style.display = "block";
    console.log("testSignUpEmail(signUpEmailInput)",testSignUpEmail(signUpEmailInput));
    allInputsValid = false;
  }

  if (testSignUpAddress(signUpAddressInput)){
    signUpAddressError.innerHTML = "";
    signUpAddressError.style.display = "none";
    console.log("testSignUpAddress(signUpAddressInput)",testSignUpAddress(signUpAddressInput))
    allInputsValid = true;
  } else {
    signUpAddressError.innerHTML = "Please enter a valid address";
    signUpAddressError.style.display = "block";
    console.log("testSignUpAddress(signUpAddressInput)",testSignUpAddress(signUpAddressInput))
     allInputsValid = false;
  }

  allInputsValid = testSignUpAddress(signUpAddressInput) && testSignUpEmail(signUpEmailInput) &&testSignUpName(signUpNameInput);
  return  allInputsValid;

}
      </script>
      <script
        src="https://kit.fontawesome.com/0ef6f85575.js"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>
