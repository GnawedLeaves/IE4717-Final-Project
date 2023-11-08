<?php
session_start();
var_dump($_SESSION);
$id = session_id();
echo "<br> Session id in pizza = $id <br>";
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
          <a href="allorders.php" class="navbarItem">Your Orders</a>
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
            <div class="item-container">
              <img class="item-img" src="./assets/images/hawaiiwanpizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Hawaiian</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-price"><?php include './php/getHawaiianPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
            <div class="item-container">
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
                  <div class="item-price"><?php include './php/getChickenGalorePrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
            <div class="item-container">
              <img
                class="item-img"
                src="./assets/images/Chrisspecialpizza.png"
              />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Chris' Special</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-price"><?php include './php/getChrisSpecialPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
            <div class="item-container">
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
                  <div class="item-price"><?php include './php/getChickenCurryPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
            <div class="item-container">
              <img class="item-img" src="./assets/images/meatloverspizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Meat Lovers</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-price"><?php include './php/getMeatLoversPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
            <div class="item-container">
              <img class="item-img" src="./assets/images/pepperonipizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Pepperoni</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-price"><?php include './php/getPepperoniPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
            <div class="item-container">
              <img class="item-img" src="./assets/images/veggiepizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">Veggie Pizza</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-price"><?php include './php/getVeggiePizzaPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
            <div class="item-container">
              <img class="item-img" src="./assets/images/bbqchickenpizza.png" />
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-title">BBQ Chicken</div>
                </div>
              </div>
              <div class="item-info-container">
                <div class="item-info-row">
                  <div class="item-price"><?php include './php/getBBQChickenPrice.php'; ?></div>
                  <button
                    class="item-cta-button"
                    onclick="changePage('ordering.php')"
                  >
                    Select
                  </button>
                </div>
              </div>
            </div>
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

        let cart = document.getElementById("cart");
        function showCart() {
          // cart.style.display = "flex";
          cart.style.transform = "translate(0%, -50%)";
        }

        function hideCart() {
          // cart.style.display = "none";
          cart.style.transform = "translate(100%, -50%)";
        }
      </script>
      <script
        src="https://kit.fontawesome.com/0ef6f85575.js"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>
