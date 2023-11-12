<?php
session_start();
error_reporting(E_ERROR | E_PARSE);


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
<link href="https://fonts.googleapis.com/css2?family=Calistoga&family=Galada&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
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
          <i class="nav-icon fa-solid fa-cart-shopping fa-2xl"  onclick="showCart()">
          <?php
          if (isset($_SESSION['cart'])) {
            if (count($_SESSION['cart']) > 0) {
              echo "<div class='cart-number'>" . count($_SESSION['cart']) . " </div>";
            }
          }
          ?></i>
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
        
        <?php

        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
          echo '<div class="cart-orders-container">';
          foreach ($_SESSION['cart'] as $index => $cartItem) {
            // $id = $cartItem['id'];
            $pizzaName = $cartItem['pizzaName'];
            $pizzaQty = $cartItem['pizzaQty'];
            $pizzaQtySubtotal = $cartItem['pizzaQtySubtotal'];
            $pizzaSize = $cartItem['pizzaSize'];
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
            if (isset($pizzaName)) {
              // echo "<br/>";
              // echo "Array Index: $index<br>";
              // echo "<br/>";
              echo '<form method="POST" action="./php/deleteCartItem.php" class="cart-order-container">';
              echo '<div class="cart-item-container">';
              // echo "Array Index: $index<br>";
              echo '<input class="phphiddendiv" name="index" value="' . $index . '">';
              echo '<div class="cart-order-title">' . $pizzaQty . 'x ' . ucfirst($pizzaSize) . " " . $pizzaName . '</div>';
              echo '<div class="cart-order-subtotal" id = >$' . number_format($phpTotal, 2) . '</div>';
              echo '</div>';

              echo '<div class="cart-more-details-container">';
              if ($pizzaTopping1Qty != 1 || $pizzaTopping2Qty != 1 || $pizzaTopping3Qty != 1) {
                echo '<div class="cart-toppings-container">';
                echo '<b>Toppings:</b>';
                if ($pizzaTopping1Qty != 1) {
                  echo '<div class="cart-more-details">' . $pizzaTopping1Qty . 'x Pineapple</div>';
                }
                if ($pizzaTopping2Qty != 1) {
                  echo '<div class="cart-more-details">' . $pizzaTopping2Qty . 'x Ham</div>';
                }
                if ($pizzaTopping3Qty != 1) {
                  echo '<div class="cart-more-details">' . $pizzaTopping3Qty . 'x Cheese</div>';
                }
                echo '</div>';
              }
              if ($pizzaAddOn1Qty > 0 || $pizzaAddOn2Qty > 0 || $pizzaAddOn3Qty > 0) {
                echo '<div class="cart-addons-container">';
                echo '<b>Add Ons:</b>';
                if (isset($pizzaAddOn1Qty) && $pizzaAddOn1Qty > 0) {
                  echo '<div class="cart-addon">' . $pizzaAddOn1Qty . 'x Snack Platter ($' . number_format($pizzaAddOn1Subtotal, 2) . ')</div>';
                }
                if (isset($pizzaAddOn2Qty) && $pizzaAddOn2Qty > 0) {
                  echo '<div class="cart-addon">' . $pizzaAddOn2Qty . 'x 10pc Drumlets ($' . number_format($pizzaAddOn2Subtotal, 2) . ')</div>';
                }
                if (isset($pizzaAddOn3Qty) && $pizzaAddOn3Qty > 0) {
                  echo '<div class="cart-addon">' . $pizzaAddOn3Qty . 'x Chocolate Waffle ($' . number_format($pizzaAddOn3Subtotal, 2) . ')</div>';
                }

                echo '</div>';
              }
              echo '</div>';


              echo '<div class="cart-actions-container">';
              echo '<div class="cart-actions-subcontainer">';
              // echo '<i class="fa-regular fa-pen-to-square cart-action-icon fa-lg"></i>';
        
              echo '<button class="delete-cart-input" type="submit" name="remove" value=""><i class="fa-regular fa-trash-can cart-action-icon fa-xl"></i></button>';
              echo '</div>';
              echo '</div>';
              echo '</form>';
            }
          }
          echo ' </div>';
          echo '<div class="totals-container">';
          echo '<div class="cart-servicefee-container">';
          echo '<div class="servicefee-title">Service Fee (10%):</div>';
          echo '<div class="servicefee-amount" id="servicefee-title">$0.00</div>';
          echo '</div>';
          echo '<div class="cart-servicefee-container">';
          echo '<div class="servicefee-title">Delivery Fee:</div>';
          echo '<div class="servicefee-amount">$3.90</div>';
          echo '</div>';
          echo '<div class="cart-servicefee-container">';
          echo '<div class="cart-grand-total-title">Total:</div>';
          echo '<div class="cart-grand-total-title" id="cart-grand-total-title-price">$0.00</div>';
          echo '</div>';
          echo '</div>';
          echo '<button class="cart-checkout-button" onclick="changePage(\'checkout.php\')">';
          echo 'Check Out';
          echo '</button>';



        } else {
          echo '<h1>Cart Is Empty</h1>';
        }
        ?>

      </div>

      <div class="container">
        <div class="hero-container">
          <div class="hero-img">
            <div class="hero-label">Pizza Parties delivered in</div>
            <div class="hero-label-big">30 MINS!</div>
            <button
              class="button-filled hero-button"
              onclick="changePage('pizza.php')"
            >
              Order Now!
            </button>
          </div>
        </div>
        <div class="catagories-container">
          <div class="catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="catagory-image"
                src="./assets/images/hotoffershome.png"
              />
              <div class="catagory-caption">Hot Offers</div>
            </a>
          </div>
          <div class="catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="catagory-image"
                src="./assets/images/sharingbundleshome.png"
              />
              <div class="catagory-caption">Sharing Bundles</div>
            </a>
          </div>

          <div class="catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="catagory-image"
                src="./assets/images/pizzashome.png"
              />
              <div class="catagory-caption">Pizza</div>
            </a>
          </div>
          <div class="catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img class="catagory-image" src="./assets/images/sideshome.png" />
              <div class="catagory-caption">Sides</div>
            </a>
          </div>
          <div class="catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="catagory-image"
                src="./assets/images/drinkshome.png"
              />
              <div class="catagory-caption">Drinks</div>
            </a>
          </div>
          <div class="catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="catagory-image"
                src="./assets/images/sweettreatshome.png"
              />
              <div class="catagory-caption">Sweet Treats</div>
            </a>
          </div>
        </div>

        
        <form class="dialog-container" id="signinDialog">
          <div class="dialog-title">Sign In</div>

          <div class="signup-input=container">
            <div class="dialog-text">Email</div>
            <input
              class="dialog-input"
              type="email"
              name="signin-email"
              required
            />
          </div>

          <div class="signup-input=container">
            <div class="dialog-text">Password</div>
            <input
              class="dialog-input"
              type="password"
              name="signin-password"
              required
            />
          </div>

          <div class="signup-button-container">
            <button
              class="dialog-signin-button"
              onclick="closeDialog('sign-up-dialog')"
            >
              Sign In
            </button>
            <div class="dialog-button-subtext">
              Don't have an account?
              <span
                class="dialog-button-subtext-underline"
                onclick="swapDialogContent()"
                type="submit"
                >Sign Up</span
              >
            </div>
          </div>
        </form>
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
