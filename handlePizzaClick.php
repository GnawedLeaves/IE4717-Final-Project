<?php
session_start();
error_reporting(E_ERROR | E_PARSE);



if (!isset($_SESSION["cart"])) {
  $_SESSION['cart'] = array();
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $pizzaName = $_POST['pizzaName'];
  $pizzaQty = $_POST['pizzaQty'];
  $pizzaQtySubtotal = $_POST['pizzaQtySubtotal'];
  $pizzaTopping1Qty = $_POST['pizzaTopping1Qty'];
  $pizzaTopping2Qty = $_POST['pizzaTopping2Qty'];
  $pizzaTopping3Qty = $_POST['pizzaTopping3Qty'];
  $pizzaAddOn1Qty = $_POST['pizzaAddOn1Qty'];
  $pizzaAddOn2Qty = $_POST['pizzaAddOn2Qty'];
  $pizzaAddOn3Qty = $_POST['pizzaAddOn3Qty'];
  $pizzaAddOn1Subtotal = $_POST['pizzaAddOn1Subtotal'];
  $pizzaAddOn2Subtotal = $_POST['pizzaAddOn2Subtotal'];
  $pizzaAddOn3Subtotal = $_POST['pizzaAddOn3Subtotal'];
  $phpTotal = $_POST['phpTotal'];


  if (isset($_POST['pizzaName']) && isset($_POST['pizzaQty']) && isset($_POST['pizzaQtySubtotal'])) {
    $pizzaName = $_POST['pizzaName'];
    $pizzaQty = $_POST['pizzaQty'];
    $pizzaQtySubtotal = $_POST['pizzaQtySubtotal'];
    $pizzaSize = $_POST['pizzaSize'];
    array_push(
      $_SESSION['cart'],
      array(
        'id' => $id,
        'pizzaSize' => $pizzaSize,
        'pizzaName' => $pizzaName,
        'pizzaQty' => $pizzaQty,
        'pizzaTopping1Qty' => $pizzaTopping1Qty,
        'pizzaTopping2Qty' => $pizzaTopping2Qty,
        'pizzaTopping3Qty' => $pizzaTopping3Qty,
        'pizzaQtySubtotal' => $pizzaQtySubtotal,
        'pizzaAddOn1Qty' => $pizzaAddOn1Qty,
        'pizzaAddOn1Subtotal' => $pizzaAddOn1Subtotal,
        'pizzaAddOn2Qty' => $pizzaAddOn2Qty,
        'pizzaAddOn2Subtotal' => $pizzaAddOn2Subtotal,
        'pizzaAddOn3Qty' => $pizzaAddOn3Qty,
        'pizzaAddOn3Subtotal' => $pizzaAddOn3Subtotal,
        'phpTotal' => $phpTotal
      )
    );
    header('Location: pizza.php');
    exit();

  }
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

      <div class="subtotal-bar">
        <div class="subtotal-bar-title">Subtotal:</div>
        <div class="subtotal-bar-amount" id="subtotal-bar-amount">$0.00</div>
      </div>

      <div class="ordering-container">
        <div class="ordering-big-container">
          <a class="back-container" href="pizza.php">
            <i class="fa-solid fa-arrow-left fa-lg" style="color: #333333"></i>
            <span class="back-span">Back</span>
          </a>
          <div class="ordering-hero-container">
           
            <?php
            if (isset($_POST["hawaiian"])) {
              echo '  <div class="ordering-hero-left ordering-hero-hawaiian"> </div>';
            } else if (isset($_POST["chicken-galore"])) {
              echo '  <div class="ordering-hero-left ordering-hero-chicken-galore"> </div>';
            } else if (isset($_POST["chris-special"])) {
              echo '  <div class="ordering-hero-left ordering-hero-chris-special "> </div>';
            } else if (isset($_POST["chicken-curry"])) {
              echo '  <div class="ordering-hero-left ordering-hero-chicken-curry"> </div>';
            } else if (isset($_POST["meat-lovers"])) {
              echo '  <div class="ordering-hero-left ordering-hero-meat-lovers"> </div>';
            } else if (isset($_POST["pepperoni"])) {
              echo '  <div class="ordering-hero-left ordering-hero-pepperoni"> </div>';
            } else if (isset($_POST["veggie-pizza"])) {
              echo '  <div class="ordering-hero-left ordering-hero-veggie-pizza"> </div>';
            } else if (isset($_POST["bbq-chicken"])) {
              echo '  <div class="ordering-hero-left ordering-hero-bbq-chicken"> </div>';
            }

            ?>
            
            <div class="ordering-hero-right">

              <div class="ordering-hero-title">
              <?php
              if (isset($_POST["hawaiian"])) {
                echo $_POST["hawaiian"];
              } else if (isset($_POST["chicken-galore"])) {
                echo $_POST["chicken-galore"];
              } else if (isset($_POST["chris-special"])) {
                echo $_POST["chris-special"];
              } else if (isset($_POST["chicken-curry"])) {
                echo $_POST["chicken-curry"];
              } else if (isset($_POST["meat-lovers"])) {
                echo $_POST["meat-lovers"];
              } else if (isset($_POST["pepperoni"])) {
                echo $_POST["pepperoni"];
              } else if (isset($_POST["veggie-pizza"])) {
                echo $_POST["veggie-pizza"];
              } else if (isset($_POST["bbq-chicken"])) {
                echo $_POST["bbq-chicken"];
              }

              ?></div>
            </div>

          </div>
          <div class="step1-container">
            <div class="step1-title">Step 1: Select Size</div>
            <div class="customise-size-container">
              <div class="customise-size-buttons-container">
                <div
                  id="size-regular-button"
                  class="ordering-pizza-size-button"
                  onclick="toggleSizeButtons(this)"
                >
                  Regular <?php
                  if (isset($_POST["hawaiian"])) {
                    include './php/getHawaiianPrice.php';
                  } else if (isset($_POST["chicken-galore"])) {
                    include './php/getChickenGalorePrice.php';
                  } else if (isset($_POST["chris-special"])) {
                    include './php/getChrisSpecialPrice.php';
                  } else if (isset($_POST["chicken-curry"])) {
                    include './php/getChickenCurryPrice.php';
                  } else if (isset($_POST["meat-lovers"])) {
                    include './php/getMeatLoversPrice.php';
                  } else if (isset($_POST["pepperoni"])) {
                    include './php/getPepperoniPrice.php';
                  } else if (isset($_POST["veggie-pizza"])) {
                    include './php/getVeggiePizzaPrice.php';
                  } else if (isset($_POST["bbq-chicken"])) {
                    include './php/getBBQChickenPrice.php';
                  }

                  ?>
                </div>
                <div
                  id="size-large-button"
                  class="ordering-pizza-size-button"
                  value="19.70"
                  onclick="toggleSizeButtons(this)"
                >
                  Large  <?php
                  if (isset($_POST["hawaiian"])) {
                    include './php/getHawaiianLargePrice.php';
                  } else if (isset($_POST["chicken-galore"])) {
                    include './php/getChickenGaloreLargePrice.php';
                  } else if (isset($_POST["chris-special"])) {
                    include './php/getChrisSpecialLargePrice.php';
                  } else if (isset($_POST["chicken-curry"])) {
                    include './php/getChickenCurryLargePrice.php';
                  } else if (isset($_POST["meat-lovers"])) {
                    include './php/getMeatLoversLargePrice.php';
                  } else if (isset($_POST["pepperoni"])) {
                    include './php/getPepperoniLargePrice.php';
                  } else if (isset($_POST["veggie-pizza"])) {
                    include './php/getVeggiePizzaLargePrice.php';
                  } else if (isset($_POST["bbq-chicken"])) {
                    include './php/getBBQChickenLargePrice.php';
                  }

                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="step2-container">
            <div class="step1-title">Step 2: Customise Pizza</div>
            <div class="customise-pizza-container">
              <div class="customise-item-container">
                <div class="customise-container">
                  <div class="customise-item-title">Pineapple</div>
                  <div class="counter-container">
                    <div
                      class="counter-box"
                      id="qty-minus"
                      onclick="handleQtyCount('minus','customise-item1-qty-input','customise-item1-subtotal')"
                    >
                      -
                    </div>
                    <input
                      id="customise-item1-qty-input"
                      class="counter-box count-box"
                      type="number"
                      max="999"
                      min="0"
                      placeholder="0"
                      oninput="handleQtyValue(this,'customise-item1-subtotal')"
                    />
                    <div
                      class="counter-box"
                      id="qty-plus"
                      onclick="handleQtyCount('plus','customise-item1-qty-input','customise-item1-subtotal')"
                    >
                      +
                    </div>
                  </div>
                </div>
                <div
                  class="customise-item-subtotal"
                  id="customise-item1-subtotal"
                >
                  $0.00
                </div>
              </div>
              <div class="customise-item-container">
                <div class="customise-container">
                  <div class="customise-item-title">Ham</div>
                  <div class="counter-container">
                    <div
                      class="counter-box"
                      id="qty-minus"
                      onclick="handleQtyCount('minus','customise-item2-qty-input','customise-item2-subtotal')"
                    >
                      -
                    </div>
                    <input
                      id="customise-item2-qty-input"
                      class="counter-box count-box"
                      type="number"
                      max="999"
                      min="0"
                      placeholder="0"
                      oninput="handleQtyValue(this,'customise-item2-subtotal')"
                    />
                    <div
                      class="counter-box"
                      id="qty-plus"
                      onclick="handleQtyCount('plus','customise-item2-qty-input','customise-item2-subtotal')"
                    >
                      +
                    </div>
                  </div>
                </div>
                <div
                  class="customise-item-subtotal"
                  id="customise-item2-subtotal"
                >
                  $0.00
                </div>
              </div>
              <div class="customise-item-container">
                <div class="customise-container">
                  <div class="customise-item-title">Cheese</div>
                  <div class="counter-container">
                    <div
                      class="counter-box"
                      id="qty-minus"
                      onclick="handleQtyCount('minus','customise-item3-qty-input','customise-item3-subtotal')"
                    >
                      -
                    </div>
                    <input
                      id="customise-item3-qty-input"
                      class="counter-box count-box"
                      type="number"
                      max="999"
                      min="0"
                      placeholder="0"
                      oninput="handleQtyValue(this,'customise-item3-subtotal')"
                    />
                    <div
                      class="counter-box"
                      id="qty-plus"
                      onclick="handleQtyCount('plus','customise-item3-qty-input','customise-item3-subtotal')"
                    >
                      +
                    </div>
                  </div>
                </div>
                <div
                  class="customise-item-subtotal"
                  id="customise-item3-subtotal"
                >
                  $0.00
                </div>
              </div>
            </div>
          </div>
          <div class="step1-container">
            <div class="step1-title">Step 3: Choose Quantity</div>
            <div class="quantity-selection-container">
              <div class="counter-container">
                <div
                  class="counter-box"
                  id="qty-minus"
                  onclick="handleQtyCount('minus','qty-input')"
                >
                  -
                </div>
                <input
                  id="qty-input"
                  class="counter-box count-box"
                  type="number"
                  max="999"
                  min="0"
                  placeholder="0"
                  oninput="handleQtyValue(this)"
                />
                <div
                  class="counter-box"
                  id="qty-plus"
                  onclick="handleQtyCount('plus','qty-input')"
                >
                  +
                </div>
              </div>

              <div class="qty-price-title" id="qty-subtotal-title">$0.00</div>
            </div>
          </div>
          <div class="step1-container" style="border: none">
            <div class="step1-title">Step 4: Choose Add-Ons</div>
            <div class="add-ons-container">
              <div class="item-container">
                <img class="item-img" src="./assets/images/snackplatter.png" />
                <div class="item-info-container">
                  <div class="item-info-row">
                    <div class="item-title add-ons-title">Snack Platter</div>
                  </div>
                </div>
                <div class="item-info-container">
                  <div class="item-info-row">
                    <div class="item-price" id="addon1-subtotal-title">
                    <?php include './php/getSnackPlatterPrice.php'; ?>
                    </div>
                    <div class="phphiddendiv" id="addon1-php-price"> <?php include './php/getSnackPlatterPrice.php'; ?></div>
                    <div class="counter-container">
                      <div
                        class="counter-box counter-box-small"
                        id="qty-minus"
                        onclick="handleQtyCount('minus','addon1-qty-input','addon1-subtotal-title')"
                      >
                        -
                      </div>
                      <input
                        id="addon1-qty-input"
                        class="counter-box count-box counter-box-small add-ons-input"
                        type="number"
                        max="999"
                        min="0"
                        placeholder="0"
                        oninput="handleQtyValue(this,'addon1-subtotal-title')"
                      />
                      <div
                        class="counter-box counter-box-small"
                        id="qty-plus"
                        onclick="handleQtyCount('plus','addon1-qty-input','addon1-subtotal-title')"
                      >
                        +
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item-container">
                <img class="item-img" src="./assets/images/10pcdrumlet.png" />
                <div class="item-info-container">
                  <div class="item-info-row">
                    <div class="item-title add-ons-title">10pc Drumlets</div>
                  </div>
                </div>
                <div class="item-info-container">
                  <div class="item-info-row">
                    <div class="item-price" id="addon2-subtotal-title">
                    <?php include './php/get10pcDrumletsPrice.php'; ?>
                    </div>
                    <div class="phphiddendiv" id="addon2-php-price"> <?php include './php/get10pcDrumletsPrice.php'; ?></div>
                    <div class="counter-container">
                      <div
                        class="counter-box counter-box-small"
                        id="qty-minus"
                        onclick="handleQtyCount('minus','addon2-qty-input','addon2-subtotal-title')"
                      >
                        -
                      </div>
                      <input
                        id="addon2-qty-input"
                        class="counter-box count-box counter-box-small add-ons-input"
                        type="number"
                        max="999"
                        min="0"
                        placeholder="0"
                        oninput="handleQtyValue(this,'addon2-subtotal-title')"
                      />
                      <div
                        class="counter-box counter-box-small"
                        id="qty-plus"
                        onclick="handleQtyCount('plus','addon2-qty-input','addon2-subtotal-title')"
                      >
                        +
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item-container">
                <img
                  class="item-img"
                  src="./assets/images/chcolatewaffle.png"
                />
                <div class="item-info-container">
                  <div class="item-info-row">
                    <div class="item-title add-ons-title">Chocolate Waffle</div>
                  </div>
                </div>
                <div class="item-info-container">
                  <div class="item-info-row">
                    <div class="item-price" id="addon3-subtotal-title">
                    <?php include './php/getChocolateWafflePrice.php'; ?>
                    </div>
                    <div class="phphiddendiv" id="addon3-php-price"> <?php include './php/getChocolateWafflePrice.php'; ?></div>
                    <div class="counter-container">
                      <div
                        class="counter-box counter-box-small"
                        id="qty-minus"
                        onclick="handleQtyCount('minus','addon3-qty-input','addon3-subtotal-title')"
                      >
                        -
                      </div>
                      <input
                        id="addon3-qty-input"
                        class="counter-box count-box counter-box-small add-ons-input"
                        type="number"
                        max="999"
                        min="0"
                        placeholder="0"
                        oninput="handleQtyValue(this,'addon3-subtotal-title')"
                      />
                      <div
                        class="counter-box counter-box-small"
                        id="qty-plus"
                        onclick="handleQtyCount('plus','addon3-qty-input','addon3-subtotal-title')"
                      >
                        +
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <form class="addtocart-button-container" method='post' >
            <input class="phphiddendiv" name="pizzaName" id="pizzaName" value="             
             <?php
             if (isset($_POST["hawaiian"])) {
               echo $_POST["hawaiian"];
             } else if (isset($_POST["chicken-galore"])) {
               echo $_POST["chicken-galore"];
             } else if (isset($_POST["chris-special"])) {
               echo $_POST["chris-special"];
             } else if (isset($_POST["chicken-curry"])) {
               echo $_POST["chicken-curry"];
             } else if (isset($_POST["meat-lovers"])) {
               echo $_POST["meat-lovers"];
             } else if (isset($_POST["pepperoni"])) {
               echo $_POST["pepperoni"];
             } else if (isset($_POST["veggie-pizza"])) {
               echo $_POST["veggie-pizza"];
             } else if (isset($_POST["bbq-chicken"])) {
               echo $_POST["bbq-chicken"];
             }

             ?>" required>
            <input class="phphiddendiv" name="pizzaSize" id="pizzaSize" value="" required>
            <input class="phphiddendiv" name="pizzaQty" id="pizzaQty" value="" required>
            <input class="phphiddendiv" name="pizzaQtySubtotal" id="pizzaQtySubtotal" value="" required>
            <input class="phphiddendiv" name="pizzaTopping1Qty" id="pizzaTopping1Qty" value="1" required>
            <input class="phphiddendiv" name="pizzaTopping2Qty" id="pizzaTopping2Qty" value="1" required>
            <input class="phphiddendiv" name="pizzaTopping3Qty" id="pizzaTopping3Qty" value="1" required>


            
            <input class="phphiddendiv" name="pizzaAddOn1Qty" id="pizzaAddOn1Qty" value="" >
            <input class="phphiddendiv" name="pizzaAddOn2Qty" id="pizzaAddOn2Qty" value="" >
            <input class="phphiddendiv" name="pizzaAddOn3Qty" id="pizzaAddOn3Qty" value="" >
            <input class="phphiddendiv" name="pizzaAddOn1Subtotal" id="pizzaAddOn1Subtotal" value="" >
            <input class="phphiddendiv" name="pizzaAddOn2Subtotal" id="pizzaAddOn2Subtotal" value="" >
            <input class="phphiddendiv" name="pizzaAddOn3Subtotal" id="pizzaAddOn3Subtotal" value="" >
            <input class="phphiddendiv" name="phpTotal" id="phpTotal" value="" required>
                  <input
              class="ordering-addtocart-button"
              type="submit" name="addToCart" value="Add to Cart" 
            >
    
          </form>
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
        function handleQtyCount(type, inputId, subtotalElementId) {
          let qtyInput = document.getElementById(inputId);
          let qtyinputint = parseInt(qtyInput.value);
          if (type === "plus") {
            if (qtyinputint + 1 !== 1000) {
              qtyInput.value++;

              calculateCustomiseItemSubtotal(
                subtotalElementId,
                parseInt(qtyInput.value)
              );
            }
          } else {
            if (qtyinputint - 1 !== -1) {
              qtyInput.value--;

              calculateCustomiseItemSubtotal(
                subtotalElementId,
                parseInt(qtyInput.value)
              );
            } else if (qtyInput.value < 0) {
              qtyInput.value = 0;

              calculateCustomiseItemSubtotal(
                subtotalElementId,
                parseInt(qtyInput.value)
              );
            }
          }
        }

        function handleQtyValue(e, subtotalElementId) {
          let newValue;
          e.value = Math.abs(e.value);
          if (e.value > 1000) {
            e.value = 999;
          }
          calculateCustomiseItemSubtotal(subtotalElementId, parseInt(e.value));
        }

        function calculateCustomiseItemSubtotal(subtotalElementId, qty) {
          let subtotalElement = document.getElementById(subtotalElementId);
          let price = 1.0;
          let subtotal = 0;
          if (
            subtotalElementId === "addon1-subtotal-title" ||
            subtotalElementId === "addon2-subtotal-title" ||
            subtotalElementId === "addon3-subtotal-title"
          ) {
            if (subtotalElementId === "addon1-subtotal-title"){
              price = cleanUpStringToFloat(document.getElementById('addon1-php-price').innerHTML)
            }
            else if (subtotalElementId === "addon2-subtotal-title"){
              price = cleanUpStringToFloat(document.getElementById('addon2-php-price').innerHTML)
            }
            else if (subtotalElementId === "addon3-subtotal-title"){
              price = cleanUpStringToFloat(document.getElementById('addon3-php-price').innerHTML)
            }

          
            subtotal = (qty * price).toFixed(2);

            if (subtotalElement) {
              subtotalElement.innerHTML = "$" + subtotal;
              subtotalElement.value = parseFloat(subtotal);
            }

            calculateTotalSubtotalForCart();
          } else {
            //for setting hidden input for php
            if (subtotalElementId === "customise-item1-subtotal"){
              document.getElementById('pizzaTopping1Qty').value = qty;
            }
            else if (subtotalElementId === "customise-item2-subtotal"){
              document.getElementById('pizzaTopping2Qty').value = qty;
            }
            else if(subtotalElementId === "customise-item3-subtotal"){
              document.getElementById('pizzaTopping3Qty').value = qty;
            }
            price = 1.0;
            subtotal = ((qty - 1) * price).toFixed(2);
            if (subtotalElement) {
              if (qty === 0 || qty === 1) {
                subtotalElement.innerHTML = "$0.00";
                subtotalElement.value = parseFloat(0);
              } else {
                subtotalElement.innerHTML = "$" + subtotal;
                subtotalElement.value = parseFloat(subtotal);
              }
            }
            handleQtySubtotal();
          }
        }

        function handleAddOnsSubtotal() {}

        //pre setting all the input fields to have 1 in their field
        var allNumberInputs = document.querySelectorAll('input[type="number"]');
        allNumberInputs.forEach((input, index) => {
          input.value = 1;
        });

        var allAddonsInputs = document.getElementsByClassName("add-ons-input");

        Array.from(allAddonsInputs).forEach((input, index) => {
          input.value = 0;
        });

        //TODO: Code the function for subtotal for quantity

        let largeButton = document.getElementById("size-large-button");
        let regularButton = document.getElementById("size-regular-button");

        function toggleSizeButtons(e) {
          buttonId = e.id;
          if (buttonId === "size-large-button") {
            document.getElementById('pizzaSize').value = 'large'
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
            document.getElementById('pizzaSize').value = 'regular'
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
          handleQtySubtotal();
        }

        function handleQtySubtotal() {
          let subtotal;
          let customiseItem1 = document.getElementById(
            "customise-item1-subtotal"
          ).innerHTML;
          let customiseItem2 = document.getElementById(
            "customise-item2-subtotal"
          ).innerHTML;
          let customiseItem3 = document.getElementById(
            "customise-item3-subtotal"
          ).innerHTML;
          let selectedSizeElementText = document.getElementsByClassName(
            "ordering-catagory-container-selected"
          )[0];
          let qtySubtotalTitle = document.getElementById("qty-subtotal-title");
          let qtyElement = document.getElementById("qty-input");

          if (selectedSizeElementText) {
            let sizePrice = cleanUpStringToFloat(
              selectedSizeElementText.innerHTML
            );
            let item1Price = cleanUpStringToFloat(customiseItem1);
            let item2Price = cleanUpStringToFloat(customiseItem2);
            let item3Price = cleanUpStringToFloat(customiseItem3);
            let qty = cleanUpStringToFloat(qtyElement.value);

            subtotal = (sizePrice + item1Price + item2Price + item3Price) * qty;
            qtySubtotalTitle.innerHTML = "$" + subtotal.toFixed(2);

            //setting the values of the hidden inputs for php
            document.getElementById('pizzaQty').value = qty;
            document.getElementById('pizzaQtySubtotal').value = subtotal;
            calculateTotalSubtotalForCart(subtotal);
          } else {
            alert("You have not selected a size!");
          }
        }

        function cleanUpStringToFloat(input) {
          return parseFloat(input.replace(/[^\d.]/g, ""));
        }

        function calculateTotalSubtotalForCart() {
          let totalForCart,
            addOnsSubtotal = 0;
          let qtySubtotalTitle =
            document.getElementById("qty-subtotal-title").innerHTML;
          qtySubtotal = cleanUpStringToFloat(qtySubtotalTitle);

          let addonSubtotal1 = cleanUpStringToFloat(
            document.getElementById("addon1-subtotal-title").innerHTML
          );
          let addonSubtotal2 = cleanUpStringToFloat(
            document.getElementById("addon2-subtotal-title").innerHTML
          );
          let addonSubtotal3 = cleanUpStringToFloat(
            document.getElementById("addon3-subtotal-title").innerHTML
          );

          let addonQty1 = document.getElementById("addon1-qty-input").value;
          let addonQty2 = document.getElementById("addon2-qty-input").value;
          let addonQty3 = document.getElementById("addon3-qty-input").value;
     
          //setting addon hidden input for php if the customer added add on then it will set the value 
          if(addonQty1 >= 1){
            document.getElementById('pizzaAddOn1Subtotal').value = addonSubtotal1;
            document.getElementById('pizzaAddOn1Qty').value =addonQty1;
            
          }
          if (addonQty2 >= 1){
            document.getElementById('pizzaAddOn2Subtotal').value = addonSubtotal2;
            document.getElementById('pizzaAddOn2Qty').value =addonQty2;

          }
          if (addonQty3 >= 1){
            document.getElementById('pizzaAddOn3Subtotal').value = addonSubtotal3;
            document.getElementById('pizzaAddOn3Qty').value =addonQty3;

          }

          totalForCart =
            qtySubtotal +
            (addonQty1 >= 1 ? addonSubtotal1 : 0) +
            (addonQty2 >= 1 ? addonSubtotal2 : 0) +
            (addonQty3 >= 1 ? addonSubtotal3 : 0);

          document.getElementById("subtotal-bar-amount").innerHTML =
            "$" + totalForCart.toFixed(2);
          document.getElementById('phpTotal').value = totalForCart;
        }
                //CART FUNCTIONS
                function changePage(url) {
          window.location.href = url;
        }
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
      <script src="script.js"></script>
      <script
        src="https://kit.fontawesome.com/0ef6f85575.js"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>
