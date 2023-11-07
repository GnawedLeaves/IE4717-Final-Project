<?php
session_start();

$id = session_id();
echo "Session id in pizza test = $id <br>";



if (!isset($_SESSION["cart"])) {
  $_SESSION['cart'] = array();
}

// var_dump($_SESSION['cart']);
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// $pizzaName = $_POST['pizzaName'];
// $pizzaQty = $_POST['pizzaQty'];
// $pizzaSize = $_POST['pizzaSize'];
// $pizzaQtySubtotal = $_POST['pizzaQtySubtotal'];
// $pizzaTopping1Qty = $_POST['pizzaTopping1Qty'];
// $pizzaTopping2Qty = $_POST['pizzaTopping2Qty'];
// $pizzaTopping3Qty = $_POST['pizzaTopping3Qty'];
// $pizzaAddOn1Qty = $_POST['pizzaAddOn1Qty'];
// $pizzaAddOn2Qty = $_POST['pizzaAddOn2Qty'];
// $pizzaAddOn3Qty = $_POST['pizzaAddOn3Qty'];
// $phpTotal = $_POST['phpTotal'];


//   $id = session_id();
//   echo "Session id in pizza test = $id <br>";

//   if (isset($_POST['pizzaName']) && isset($_POST['pizzaQty']) && isset($_POST['pizzaQtySubtotal']) && isset($_POST['pizzaSize'])) {
//     $pizzaName = $_POST['pizzaName'];
//     $pizzaQty = $_POST['pizzaQty'];
//     $pizzaQtySubtotal = $_POST['pizzaQtySubtotal'];
//     $pizzaSize = $_POST['pizzaSize'];
//     array_push(
//       $_SESSION['cart'],
//       array(
//         'pizzaSize' => $pizzaSize,
//         'pizzaName' => $pizzaName,
//         'pizzaQty' => $pizzaQty,
//         'pizzaQtySubtotal' => $pizzaQtySubtotal
//       )
//     );

//   }


//   echo "SESSION: " . var_dump($_SESSION);
//   unset($_POST);
//   header('Location: pizza.php');
// }




if (isset($_SESSION['cart'])) {
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
      echo "<br/>";
      echo "Array Index: $index<br>";
      echo "Item ID: $id<br>";
      echo "Pizza Name: $pizzaName<br>";
      echo "Quantity: $pizzaQty<br>";
      echo "Size: $pizzaSize<br>";
      echo "Topping 1: $pizzaTopping1Qty<br>";
      echo "Topping 2: $pizzaTopping2Qty<br>";
      echo "Topping 3: $pizzaTopping3Qty<br>";
      echo "Subtotal: $pizzaQtySubtotal<br>";
      echo "<br/>";
    } else {
      if (isset($pizzaAddOn1Qty) && $pizzaAddOn1Qty > 0) {
        echo "<br/>";
        echo "Array Index: $index<br>";
        echo "Item ID: $id<br>";
        echo "Add on Name: 1<br>";
        echo "Quantity: $pizzaAddOn1Qty<br>";
        echo "Subtotal: $pizzaAddOn1Subtotal<br>";
        echo "<br/>";

      }
      if (isset($pizzaAddOn2Qty) && $pizzaAddOn2Qty > 0) {
        echo "<br/>";
        echo "Array Index: $index<br>";
        echo "Item ID: $id<br>";
        echo "Add on Name: 2<br>";
        echo "Quantity: $pizzaAddOn2Qty<br>";
        echo "Subtotal: $pizzaAddOn2Subtotal<br>";
        echo "<br/>";

      }
      if (isset($pizzaAddOn3Qty) && $pizzaAddOn3Qty > 0) {
        echo "<br/>";
        echo "Array Index: $index<br>";
        echo "Item ID: $id<br>";
        echo "Add on Name: 3<br>";
        echo "Quantity: $pizzaAddOn3Qty<br>";
        echo "Subtotal: $pizzaAddOn3Subtotal<br>";
        echo "<br/>";

      }


    }

  }
} else {
  echo 'cart is empty';
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
      <form class="dialog-container" id="signupDialog" method="dialog">
        <div class="dialog-title">Sign Up</div>

        <div class="signup-input-container">
          <div class="dialog-text">Name</div>
          <input class="dialog-input" type="text" name="signup-name" required />
        </div>
        <div class="signup-input-container">
          <div class="dialog-text">Email</div>
          <input
            class="dialog-input"
            type="email"
            name="signup-email"
            required
          />
        </div>

        <div class="signup-input-container">
          <div class="dialog-text">Password</div>
          <input
            class="dialog-input"
            type="password"
            name="signup-password"
            required
          />
        </div>

        <div class="signup-input-container">
          <div class="dialog-text">Address</div>
          <input
            class="dialog-input"
            type="text"
            name="signup-address"
            required
          />
        </div>
        <div class="signup-input-container">
          <div class="dialog-text">Contact Number</div>
          <input class="dialog-input" type="number" name="signup-contact" />
        </div>

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
      <form class="dialog-container" id="signinDialog" method="dialog">
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
          <button class="dialog-signin-button" id="dialog-signin-button">
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
          <a href="#" class="navbarItem">Your Orders</a>
          <a href="stores.php" class="navbarItem">Stores</a>
          <a href="#" class="navbarItem">Support</a>
        </div>

        <div class="cart-profile-container">
          <i
            class="nav-icon fa-solid fa-cart-shopping fa-xl"
            onclick="showCart()"
          ></i>
          <button
            class="button-filled join-button"
            onclick="openDialog('sign-up-dialog')"
          >
            Join Us
          </button>
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
              echo '<i class="fa-regular fa-pen-to-square cart-action-icon fa-lg"></i>';

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

       
        <!-- <div class="totals-container">
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
        </button> -->
      </div>

      <div class="page-title-container">
        <div class="page-title">Pizza</div>
      </div>

      <div class="catagories-container smaller-catagories-container">
        <div class="smaller-inner-catagory-container">
          <div class="smaller-catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="smaller-catagory-image"
                src="./assets/images/hotoffershome.png"
              />
              <div class="catagory-caption">Hot Offers</div>
            </a>
          </div>
          <div class="smaller-catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="smaller-catagory-image"
                src="./assets/images/sharingbundleshome.png"
              />
              <div class="catagory-caption">Sharing Bundles</div>
            </a>
          </div>

          <div class="smaller-catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="smaller-catagory-image"
                src="./assets/images/pizzashome.png"
              />
              <div class="catagory-caption">Pizza</div>
            </a>
          </div>
          <div class="smaller-catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="smaller-catagory-image"
                src="./assets/images/sideshome.png"
              />
              <div class="catagory-caption">Sides</div>
            </a>
          </div>
          <div class="smaller-catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="smaller-catagory-image"
                src="./assets/images/drinkshome.png"
              />
              <div class="catagory-caption">Drinks</div>
            </a>
          </div>
          <div class="smaller-catagory-container">
            <a href="pizza.php" class="catagory-link-container">
              <img
                class="smaller-catagory-image"
                src="./assets/images/sweettreatshome.png"
              />
              <div class="catagory-caption">Sweet Treats</div>
            </a>
          </div>
        </div>
      </div>

      <div class="container" onclick="hideCart()">
        <div class="big-ordering-container">
          <div class="ordering-catagories-container">
            <div
              class="ordering-catagory-container"
              onclick="toggleOrderingCatagoryButton(this)"
            >
              Chicken
            </div>
            <div
              class="ordering-catagory-container"
              onclick="toggleOrderingCatagoryButton(this)"
            >
              Beef
            </div>
            <div
              class="ordering-catagory-container"
              onclick="toggleOrderingCatagoryButton(this)"
            >
              Vegetarian
            </div>
          </div>
          <div class="ordering-container">
            <form class="item-container" action='handlePizzaClick.php' method='post'>
              <img class="item-img" src="./assets/images/hawaiiwanpizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title" name="Hawaiiandiv">Hawaiian</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                  <input class="phphiddendiv" value="Hawaiian" name="hawaiian" type="text">
                  <div class="item-price"><?php include './php/getHawaiianPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
              
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
            <form class="item-container" action='handlePizzaClick.php' method='post'>
              <img
                class="item-img"
                src="./assets/images/chickengalorepizza.png"
              />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Chicken Galore</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                <input class="phphiddendiv" value="Chicken Galore" name="chicken-galore" type="text">
                  <div class="item-price"><?php include './php/getChickenGalorePrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
<form class="item-container" action='handlePizzaClick.php' method='post'>
              <img
                class="item-img"
                src="./assets/images/Chrisspecialpizza.png"
              />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Chris Special</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                <input class="phphiddendiv" value="Chris Special" name="chris-special" type="text">
                  <div class="item-price"><?php include './php/getChrisSpecialPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
<form class="item-container" action='handlePizzaClick.php' method='post'>
              <img
                class="item-img"
                src="./assets/images/chickencurrypizza.png"
              />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Chicken Curry</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                <input class="phphiddendiv" value="Chicken Curry" name="chicken-curry" type="text">
                  <div class="item-price"><?php include './php/getChickenCurryPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
<form class="item-container" action='handlePizzaClick.php' method='post'>
              <img class="item-img" src="./assets/images/meatloverspizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Meat Lovers</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                <input class="phphiddendiv" value="Meat Lovers" name="meat-lovers" type="text">
                  <div class="item-price"><?php include './php/getMeatLoversPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
<form class="item-container" action='handlePizzaClick.php' method='post'>
              <img class="item-img" src="./assets/images/pepperonipizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Pepperoni</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                <input class="phphiddendiv" value="Pepperoni" name="pepperoni" type="text">
                  <div class="item-price"><?php include './php/getPepperoniPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
<form class="item-container" action='handlePizzaClick.php' method='post'>
              <img class="item-img" src="./assets/images/veggiepizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Veggie Pizza</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                <input class="phphiddendiv" value="Veggie Pizza" name="veggie-pizza" type="text">
                  <div class="item-price"><?php include './php/getVeggiePizzaPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
<form class="item-container" action='handlePizzaClick.php' method='post'>
              <img class="item-img" src="./assets/images/bbqchickenpizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">BBQ Chicken</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                <input class="phphiddendiv" value="BBQ Chicken" name="bbq-chicken" type="text">
                  <div class="item-price"><?php include './php/getBBQChickenPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
</form>
</div>
          <div class="see-more-container">
            <button class="see-more-button">See More >></button>
          </div>
        </div>
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

        function cleanUpStringToFloat(input) {
  return parseFloat(input.replace(/[^\d.]/g, ""));
}


        //CART FUNCTIONS

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




        
      </script>
      <script src="script.js"></script>
      <script
        src="https://kit.fontawesome.com/0ef6f85575.js"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>
