<?php
session_start();

$id = session_id();
echo "Session id in pizza test = $id <br>";



if (!isset($_SESSION["cart"])) {
  $_SESSION['cart'] = array();
} else {
  echo 'cart exists';
}


echo "SESSION: " . var_dump($_SESSION);
echo "CART: " . $_SESSION['cart'];



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
  $phpTotal = $_POST['phpTotal'];


  $id = session_id();
  echo "Session id in pizza test = $id <br>";

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
        'pizzaQtySubtotal' => $pizzaQtySubtotal
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
    <title>Chris' Pizza</title>
    <style></style>
  </head>
  <body>
    <dialog id="sign-up-dialog">
      This is a dialog box
      <button onclick="closeDialog('sign-up-dialog')" id="close-dialog-btn">
        Close
      </button>
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
          <a href="stores.html" class="navbarItem">Stores</a>
          <a href="#" class="navbarItem">Support</a>
        </div>

        <div class="cart-profile-container">
          <i class="nav-icon fa-solid fa-cart-shopping fa-xl"></i>
          <button class="button-filled join-button">Join Us</button>
        </div>
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

            <input class="phphiddendiv" name="pizzaAddOn1Qty" id="pizzaAddOn1Qty" value="0" required>
            <input class="phphiddendiv" name="pizzaAddOn2Qty" id="pizzaAddOn2Qty" value="0" required>
            <input class="phphiddendiv" name="pizzaAddOn3Qty" id="pizzaAddOn3Qty" value="0" required>
            <input class="phphiddendiv" name="phpTotal" id="phpTotal" value="1" required>
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

            console.log("price",price)
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
     
          totalForCart =
            qtySubtotal +
            (addonQty1 >= 1 ? addonSubtotal1 : 0) +
            (addonQty2 >= 1 ? addonSubtotal2 : 0) +
            (addonQty3 >= 1 ? addonSubtotal3 : 0);

          document.getElementById("subtotal-bar-amount").innerHTML =
            "$" + totalForCart.toFixed(2);
        }

        function handleAddtocart() {}
      </script>
      <script src="script.js"></script>
      <script
        src="https://kit.fontawesome.com/0ef6f85575.js"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>
