<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chrispizza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//Insert customer data and check if they are a memeber already
$checkoutName = $_POST["checkout-name"];
$checkoutEmail = $_POST["checkout-email"];
$checkoutAddress = $_POST["checkout-address"];
$checkoutContact = $_POST["checkout-contact"];



if (isset($_POST["checkout-email"])) {
  $checkoutName = $_POST["checkout-name"];
  $checkoutEmail = $_POST["checkout-email"];
  $checkoutAddress = $_POST["checkout-address"];
  $checkoutContact = $_POST["checkout-contact"];

  // Check if a customer with this email already exists
  $sql = "SELECT * FROM customers WHERE email = '$checkoutEmail'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Get the customer ID of the customer with this email.
    $customer = $result->fetch_assoc();
    $existingCustomerId = $customer["customer_id"];
    $customerId = $existingCustomerId;
    $_SESSION['customer_id'] = $customerId;

    if ($checkoutAddress !== $customer["address"]) {
      $sql = "UPDATE customers SET address = '$checkoutAddress' WHERE customer_id = '$customerId'";
      if ($conn->query($sql) === TRUE) {
        // echo "Address updated successfully";
      } else {
        // echo "Error updating record: " . $conn->error;
      }
    }
    if ($checkoutContact !== $customer["contact"]) {
      $sql = "UPDATE customers SET contact = '$checkoutContact' WHERE customer_id = '$customerId'";
      if ($conn->query($sql) === TRUE) {
        // echo "Contact updated successfully";
      } else {
        // echo "Error updating record: " . $conn->error;
      }
    }
    if ($checkoutName !== $customer["name"]) {
      $sql = "UPDATE customers SET name = '$checkoutName' WHERE customer_id = '$customerId'";
      if ($conn->query($sql) === TRUE) {
        // echo "Name updated successfully";
      } else {
        // echo "Error updating record: " . $conn->error;
      }
    }

  } else {
    // Adding a new customer

    $type = 'guest';

    // Insert the customer data into the database
    $sql = "INSERT INTO customers (name, email, address, contact, type) 
              VALUES ('$checkoutName', '$checkoutEmail', '$checkoutAddress', '$checkoutContact', '$type')";

    if ($conn->query($sql) === TRUE) {
      // Customer data inserted successfully.


      // Get the customer ID of the customer just inserted.
      $newCustomerId = $conn->insert_id;
      $customerId = $newCustomerId;
      $_SESSION['customer_id'] = $customerId;
    } else {
      // Handle the case where the insert operation fails.
      // echo "Error: " . $conn->error;
    }
  }
}


if (isset($_POST['cartgrandtotal'])) {
  $cartgrandtotal = $_POST['cartgrandtotal'];
}



//end of customer Id handling 

//start of order sql handling
$orderId = uniqid();
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
  //Inserting into order summary first: 
  date_default_timezone_set('Asia/Singapore');
  $currentDateTime = new DateTime();
  $currentDateTime->add(new DateInterval('PT30M'));
  $dateTimeForSQL = $currentDateTime->format('Y-m-d H:i:s');


  $orderDateTime = new DateTime();
  $orderDateTimeForSQL = $orderDateTime->format('Y-m-d H:i:s');




  $sql = "INSERT INTO orderSummary (order_id, customer_id, total, date, delivery_time, status) VALUES ('$orderId', $customerId, '$cartgrandtotal', '$orderDateTimeForSQL','$dateTimeForSQL' ,'In the Kitchen')";
  if ($conn->query($sql) === TRUE) {
    foreach ($_SESSION['cart'] as $index => $cartItem) {
      $pizzaName = ltrim($cartItem['pizzaName']);
      $pizzaSize = $cartItem['pizzaSize'];
      $pizzaQty = $cartItem['pizzaQty'];
      $pizzaQtySubtotal = $cartItem['pizzaQtySubtotal'];
      $pizzaTopping1Qty = $cartItem['pizzaTopping1Qty'];
      $pizzaTopping2Qty = $cartItem['pizzaTopping2Qty'];
      $pizzaTopping3Qty = $cartItem['pizzaTopping3Qty'];
      $pizzaAddOn1Qty = $cartItem['pizzaAddOn1Qty'];
      $pizzaAddOn2Qty = $cartItem['pizzaAddOn2Qty'];
      $pizzaAddOn3Qty = $cartItem['pizzaAddOn3Qty'];
      $pizzaAddOn1Subtotal = $cartItem['pizzaAddOn1Subtotal'];
      $pizzaAddOn2Subtotal = $cartItem['pizzaAddOn2Subtotal'];
      $pizzaAddOn3Subtotal = $cartItem['pizzaAddOn3Subtotal'];
      $phpTotal = $cartItem['phpTotal'];


      //getting the item id 
      if (isset($pizzaName) && isset($pizzaSize)) {

        $sql = "SELECT itemid FROM menu WHERE name = '$pizzaName' AND size = '$pizzaSize'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $itemId = $row["itemid"];

        }
      }

      if (empty($pizzaAddOn1Qty)) {
        $pizzaAddOn1Qty = 0;
      }
      if (empty($pizzaAddOn2Qty)) {
        $pizzaAddOn2Qty = 0;
      }
      if (empty($pizzaAddOn3Qty)) {
        $pizzaAddOn3Qty = 0;
      }


      //insert orders
      $sql = "INSERT INTO orders (order_id, item_id, quantity, topping1, topping2, topping3, addon1, addon2, addon3, sub_total)
      VALUES ('$orderId', $itemId, $pizzaQty, $pizzaTopping1Qty, $pizzaTopping2Qty, $pizzaTopping3Qty, $pizzaAddOn1Qty, $pizzaAddOn2Qty, $pizzaAddOn3Qty, $phpTotal)";
      if ($conn->query($sql) === TRUE) {

        $sql = "UPDATE customers SET orders = '$orderId' WHERE customer_id = '$customerId'";
        if ($conn->query($sql) === TRUE) {
          $dateFormatted = $currentDateTime->format('j M Y');
          $timeFormatted = $currentDateTime->format('H:i:s');

          $currentDateTime2 = new DateTime();
          $dateFormatted2 = $currentDateTime2->format('j M Y');
          $timeFormatted2 = $currentDateTime2->format('H:i:s');
          $to = 'f32ee@localhost';
          $subject = 'Your Delicious Pizza Order is Confirmed! ';
          $message = "Hi " . $checkoutName . ",<br/><br/>" . "We're thrilled to let you know that your pizza order is officially confirmed and in the works! Our expert chefs are gearing up to craft the perfect, mouthwatering pizza experience just for you."
            . "<br/>Here are the details of your order:<br/><br/>
Order Number: " . $orderId . "<br/> 
Delivery Address: " . $checkoutAddress . "<br/>
Date Ordered: " . $dateFormatted2 . " " . $timeFormatted2 . "<br/>
Estimated Delivery Time: " . $dateFormatted . " " . $timeFormatted . "<br/><br/>"
            . "You can view and track your order <a href='http://localhost:8000/YAPQ0006/Documents/IE4717/IE4717-Final-Project/order-summary.php?queryOrderId=$orderId'>here</a>.<br/>"
            . "If you have any special requests or need to make any changes to your order, feel free to reply to this email or give us a call at +65 6347 3287 or drop us an email at chrispizza@gmail.com.<br/>"
            . "Thank you once again for choosing Chris' Pizza. We can't wait for you to savor the deliciousness we have in store for you!<br/><br/>"
            . "Best Regards,<br/>
Chris' Pizza";
          $headers = 'From: f32ee@localhost' . "\r\n" .
            'Reply-To: f32ee@localhost' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
          $headers .= "\r\nContent-Type: text/html; charset=UTF-8\r\n";
          mail(
            $to,
            $subject,
            $message,
            $headers,
            '-ff32ee@localhost'
          );

        }
      } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;

      }

    }
  }
  $_SESSION['feedback'] = false;
  $_SESSION['cart'] = array();

}


//change so that the cart will be cleared when the order is complete
if (!isset($_SESSION["cart"])) {
  $_SESSION['cart'] = array();
}





?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Calistoga&family=Galada&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="./assets/images/favicon/favicon.ico" type="image/x-icon"/>
    <title>Chris' Pizza</title>
    <style></style>
  </head>
  <body>
  <dialog id="sign-up-dialog" class="signup-dialog">
      <i
        class="fa-solid fa-xmark fa-l"
        id="dialog-close-icon"
        onclick="closeDialog('sign-up-dialog')"
      ></i>
      <form class="dialog-container" onsubmit="submitSignupForm(); return false;" id="signupDialog" method="post" action = './php/signUp.php'>

        <div class="dialog-title">Sign Up</div>

        <div class="signup-input-container">
          <div class="dialog-text">Name</div>
          <input class="dialog-input" type="text" name="signup-name" id="signup-name" required />
          <div style="color: red;" id="signup-name-error"></div>
        </div>
        <div class="signup-input-container">
          <div class="dialog-text">Email</div>
          <input
            class="dialog-input"
            type="email"
            name="signup-email"
            id = "signup-email"
            required
          />
          <div style="color: red;" id="signup-email-error"></div>
        </div>

        <div class="signup-input-container">
          <div class="dialog-text">Password</div>
          <input
            class="dialog-input"
            type="password"
            name="signup-password"
            id="signup-password"
            required
          />
          <div style="color: red;" id="signup-password-error"></div>
        </div>

        <div class="signup-input-container">
          <div class="dialog-text">Address</div>
          <input
            class="dialog-input"
            type="text"
            name="signup-address"
            id="signup-address"
            required
          />
          <div style="color: red;" id="signup-address-error"></div>
        </div>
        <div class="signup-input-container">
          <div class="dialog-text">Contact Number</div>
          <input class="dialog-input" type="number" name="signup-contact" />
        </div>
        <div id="signup-error"></div>
        <div class="signup-button-container">
          <button class="dialog-signin-button" id="dialog-signup-button">
            Sign Up
          </button>
          <div class="dialog-button-subtext">
            Already have an account?
            <span
              class="dialog-button-subtext-underline"
              onclick="swapDialogContent()"
              >Sign In</span
            >
          </div>
        </div>
      </form>
      <form class="dialog-container" onsubmit="submitSigninForm(); return false;" id="signinDialog" method="post" action = './php/signIn.php'>
        <div class="dialog-title">Sign In</div>
        
        <div class="signup-input=container">
          <div class="dialog-text">Email</div>
          <input
            class="dialog-input"
            type="email"
            name="signin-email"
            id="signin-email"
            required
          />
          <div style="color: red;" id="signin-error-email"></div>
        </div>

        <div class="signup-input=container">
          <div class="dialog-text">Password</div>
          <input
            class="dialog-input"
            type="password"
            name="signin-password"
            id="signin-password"
            required
          />
          <div id="signin-error-password"></div>
        </div>
       

        <div class="signup-button-container">
          <button class="dialog-signin-button" id="dialog-signin-button" name = "sign-in-submit">
            Sign In
          </button>
          <div class="dialog-button-subtext">
            Don't have an account?
            <span
              class="dialog-button-subtext-underline"
              onclick="swapDialogContent()"
              >Sign Up</span
            >
          </div>
        </div>
      </form>
    </dialog>

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

        <div class="cart-profile-container" style ="display: flex;align-items: center;">
          <!-- <i class="nav-icon fa-solid fa-cart-shopping fa-2xl"  onclick="showCart()">
          <?php
          if (isset($_SESSION['cart'])) {
            if (count($_SESSION['cart']) > 0) {
              echo "<div class='cart-number'>" . count($_SESSION['cart']) . " </div>";
            }
          }
          ?></i> -->
          <?php
          if ($_SESSION["logged_in"] && isset($_SESSION["customer_id"])) {

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "chrispizza";

            $conn = new mysqli($servername, $username, $password, $dbname);
            $customer_id = $_SESSION["customer_id"];

            $sql = "SELECT name FROM customers WHERE customer_id = $customer_id";
            $result = $conn->query($sql);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }
            if ($result) {
              $row = mysqli_fetch_assoc($result);
              $customer_name = $row['name'];
            }

            echo '<div style="display: flex; flex-direction: column; align-items: center; gap: 0.5rem;" class="logged-in-container"><div class="logged-in-details">' . $customer_name . '</div><button class="join-button button-not-filled" onclick="logout()">Log Out</button></div>';

          } else {
            echo '<button class="button-filled join-button" onclick="openDialog(\'sign-up-dialog\')">Join Us</button>';
          }

          ?>
        </div>
      </div>

      <div class="cart-container" id="cart">
        <i
          class="fa-solid fa-xmark fa-xl"
          id="cart-close-icon"
          onclick="hideCart()"
        ></i>
        <div class="cart-title">Cart</div>
        <div class="cart-orders-container">
          <div class="cart-order-container">
            <div class="cart-item-container">
              <div class="cart-order-title">1x Chocolate Waffle</div>
              <div class="cart-order-subtotal">$19.90</div>
            </div>

            <div class="cart-actions-container">
              <div class="cart-actions-subcontainer">
                <i
                  class="fa-regular fa-pen-to-square cart-action-icon fa-lg"
                ></i>
                <i class="fa-regular fa-trash-can cart-action-icon fa-lg"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="totals-container">
          <div class="cart-servicefee-container">
            <div class="servicefee-title">Service Fee (10%):</div>
            <div class="servicefee-amount">$7.90</div>
          </div>
          <div class="cart-servicefee-container">
            <div class="servicefee-title">Delivery Fee:</div>
            <div class="servicefee-amount">$3.90</div>
          </div>
          <div class="cart-servicefee-container">
            <div class="cart-grand-total-title">Total:</div>
            <div class="cart-grand-total-title">$0.00</div>
          </div>
        </div>
        <button
          class="cart-checkout-button"
          onclick="changePage('checkout.php')"
        >
          Check Out
        </button>
      </div>

      <div class="page-title-container">
        <div class="page-title">Track My Order</div>
      </div>

      <div class="container">
        <div class="page-title-container-trackingorder">
          <div class="track-order-id-title">Order ID:</div>
          <div class="track-order-id">
            
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "chrispizza";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            $customer_id = $_SESSION['customer_id'];
            $sql = "SELECT * FROM ordersummary WHERE customer_id = $customer_id ORDER BY id DESC LIMIT 1";
            $result = $conn->query($sql);
            if ($result === false) {
              // Check for errors in the query
              echo "Error: " . $conn->error;
            } else {
              if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $orderId = $row["order_id"];
                $_SESSION['currentOrderId'] = $orderId;
                echo $orderId;
              } else {
                echo 'Order does not exist';
              }
            }
            ?>
          
        
        </div>
          <div class="track-order-id-title">Estimated Delivery Time:</div>
          <div class="track-order-id-sub">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "chrispizza";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $orderId = $_SESSION['currentOrderId'];
          $sql = " SELECT DATE_FORMAT(delivery_time, '%H:%i') AS delivery_time FROM ordersummary WHERE order_id = '$orderId'";
          $result = $conn->query($sql);
          if ($result === false) {
            // Check for errors in the query
            echo "Error: " . $conn->error;
          } else {
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $delivery_time = $row["delivery_time"];
              echo $delivery_time;
            } else {
              echo 'Order does not exist';
            }
          }

          ?>
          </div>
          <div class="track-order-id-title">Status:</div>
          <div class="track-order-id-sub">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "chrispizza";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          $orderId = $_SESSION['currentOrderId'];
          $sql = " SELECT status FROM ordersummary WHERE order_id = '$orderId'";
          $result = $conn->query($sql);
          if ($result === false) {
            // Check for errors in the query
            echo "Error: " . $conn->error;
          } else {
            if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              $status = $row["status"];
              echo $status;
            } else {
              echo 'Order does not exist';
            }
          }

          ?>
          </div>
          <div class="track-order-buttons-container">
            <form action='order-summary.php' method='get'>
              <input class='phphiddendiv'  name='queryOrderId' value="<?php echo $_SESSION['currentOrderId']; ?>" />
            <button class="track-order-ordersummary-button" >
              Order Summary
            </button>
            <button  type='button' class="track-order-orderagain-button" onclick="changePage('index.php')">Order Again</button>
            </form>

           
          </div>
        </div>

        <form class="feedback-container" method = "post" action = "./php/feedbackSubmit.php">
        <?php
        $feedback = $_SESSION['feedback'];
        if ($feedback === false) {
          echo '<div class="feedback-title">Help Us Improve!</div>
      <div class="feedback-container-box">
        <div class="feedback-question-title">
          Rate your overall experience
        </div>
        <div class="feedback-rating-container">';

          for ($i = 1; $i <= 5; $i++) {
            echo '<div class="feedback-rating">
            ' . $i . '
            <input
              type="radio"
              name="rating"
              value="' . $i . '"
              class="feedback-radio"
              required
            />
          </div>';
          }

          echo '</div>
      <div class="feedback-comment-container">
        <div class="feedback-question-title">Other comments:</div>
        <textarea
          type="textarea"
          name="feedback-comment"
          class="feedback-comment"
          placeholder="Comments on the food, delivery process, etc..."
          cols="30"
          rows="7"
        ></textarea>
      </div>
      <button class="feedback-submit-button">Send</button>
    </div>';
        } else if ($feedback === true) {
          echo "<div class='feedback-failure-container'>Thank you for your feedback!</div>";
        }
        ?>
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

      <!-- <i class="nav-icon fa-solid fa-cart-shopping fa-xl"></i> -->
      <script>
        function toggleOrderingCatagoryButton(e) {
          if (e.classList.contains("ordering-catagory-container-selected")) {
            e.classList.remove("ordering-catagory-container-selected");
          } else {
            e.classList.add("ordering-catagory-container-selected");
          }
        }

        function changePage(url) {
          window.location.href = url;
        }

        // Sign up dialog functions
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

        let cart = document.getElementById("cart");
        function showCart() {
          // cart.style.display = "flex";
          cart.style.transform = "translate(0%, -50%)";
        }

        function hideCart() {
          // cart.style.display = "none";
          cart.style.transform = "translate(100%, -50%)";
        }

        let largeButton = document.getElementById("size-large-button");
        let regularButton = document.getElementById("size-regular-button");

        function toggleSizeButtons(e) {
          buttonId = e.id;

          if (buttonId === "size-large-button") {
            if (
              !regularButton.classList.contains(
                "ordering-catagory-container-selected"
              )
            ) {
              largeButton.classList.add("ordering-catagory-container-selected");
            } else if (
              regularButton.classList.contains(
                "ordering-catagory-container-selected"
              )
            ) {
              largeButton.classList.add("ordering-catagory-container-selected");
              regularButton.classList.remove(
                "ordering-catagory-container-selected"
              );
            }
          } else if (buttonId === "size-regular-button") {
            if (
              !largeButton.classList.contains(
                "ordering-catagory-container-selected"
              )
            ) {
              regularButton.classList.add(
                "ordering-catagory-container-selected"
              );
            } else if (
              largeButton.classList.contains(
                "ordering-catagory-container-selected"
              )
            ) {
              regularButton.classList.add(
                "ordering-catagory-container-selected"
              );
              largeButton.classList.remove(
                "ordering-catagory-container-selected"
              );
            }
          }
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
