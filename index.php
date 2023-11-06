<?php
if (!isset($_SESSION))
  session_start();
var_dump($_SESSION);
$id = session_id();
echo "<br> Session id in index = $id <br>";
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
      href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
      rel="stylesheet"
    />
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
          <a href="stores.html" class="navbarItem">Stores</a>
          <a href="#" class="navbarItem">Support</a>
        </div>

        <div class="cart-profile-container">
          <i class="nav-icon fa-solid fa-cart-shopping fa-xl"></i>
          <button
            class="button-filled join-button"
            onclick="openDialog('sign-up-dialog')"
          >
            Join Us
          </button>
        </div>
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
      </script>
      <script
        src="https://kit.fontawesome.com/0ef6f85575.js"
        crossorigin="anonymous"
      ></script>
    </div>
  </body>
</html>
