<?php
session_start();

// Retrieve the selected seats from the shopping cart session variable.
$shoppingCart = isset($_SESSION['shopping_cart']) ? explode(',', $_SESSION['shopping_cart']) : [];

$movieInfo = isset($_SESSION['movie_info']) ? $_SESSION['movie_info'] : [];

// Now you can display the selected seats in the shopping cart page.

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
* {
    box-sizing: border-box;
    
}
body {
    font-family: Verdana, Arial, sans-serif;
    background-color: #000233;
}
#wrapper {
    background-color: #121111;
    color: black;
    width: 80%;
    margin: 10px auto 20px;
    min-width: 850px;
    box-shadow: 5px 5px 10px;
}
header  { background-color: #121111;
          color: #00005D;
		  height: 183px;
          position: relative;
}
nav {
    float: left;
    width: 200px;
    padding: 50px 0;
	padding-left:20px;
    text-align: center;
	font-family: Jomhuria;
	font-size: 40px;
	font-weight: 400;
	word-wrap: break-word
}

nav a {
    line-height: 1.4em;
	width: 100%; 
	height: 100%;
    color: white;
	font-size: 30px;
    font-weight: bold;
    text-decoration: none;
	font-family: Jomhuria; 
	font-weight: 400; 
	background-color: #121111;
	text-align: center;
}

nav a:hover {
    color: #a8886b;
}
.content {
    float: right;
    width: calc(100% - 227px);
	/* yellow box within the box */
    background-color: #D9D9D9;
	/* color of yellow box */
    overflow: auto;
    padding: 0 0px 20px;
	/* dimension of content within yellow box */
}
footer {
    background-color: #837c7c;
    font-size: 70%;
    text-align: center;
    clear: both;
    padding: 20px;
	color:#FFF;
}
 
.breadcrumb { display:flex;
              align-items: flex-start;
			  flex-direction: column;
			  height:50px;
			 <!--  background-color:#8B9AD0 -->
			  padding-bottom:20px;
}
.hr1 {
    border: none;
    height: 2px;
    background-color: black; 
	align-self: flex-start;
 }
 .line {
    border: none;
	left: 0;
    height: 2px;
	width: 30%;
    background:linear-gradient(to right,#000, transparent);
 }
       .seat {
            width: 30px;
            height: 30px;
            margin: 5px;
            background-color: #ccc;
            display: inline-block;
            cursor: pointer;
        }
        .seat.selected {
            background-color: #f00; /* Change color to represent a selected seat */
        }
        .seating-area {
            float: left;
			padding-left: 350px;
			padding-top: 85px;
        }
        .side-seating-area {
            float: right;
			padding-right: 400px;
			padding-top: 30px;
        }
        .row {
            display: flex;
            align-items: center;
        }
        .main-row-label {
            font-weight: bold;
			margin-right: 10px;
        }
        .side-row-label {
            margin-left: 10px;
            font-weight: bold;
            order: 2;
        }
        .screen {
            width: 500px;
            height: 25px;
            background-color:#D9D9D9;
            margin-right: 10px;
            margin-left: 375px;
			margin-top: 30px;
			border: 2px solid #000;
			text-align: left;
        }
h1 { padding-left: 20px;}
 .selected-box {
            border: 2px solid #000; /* Add a border style for the selected seats box */
            padding: 10px;
			width:240px;
        }
</style>
</head>
<body>
  <div id="wrapper">
  <header>
	<img style="width: 227px; height: 183px; position: absolute; left: 0; top: 0; height: 100%;" src="lumiscreen.jpg">
	<img style="width: 473px; height: 183px; left: 600px; top: 0px; position: absolute" src="Bigmovie.jpg" />
  </header>
  <nav id="leftcolumn">
  <a href="movie.html">Movies</a><br><br>
  <a href="showtimesall.html">Showtimes</a><br><br>
  <a href="contact.php">Contact</a><br>
  </nav>
  <div class="content">
    <div class="breadcrumb">
      <h4><a href="Homepage.html" style="text-decoration: none; color: black; padding: 0 50px 20px;">HOME</a></h4>
	</div>
	<hr class="hr1">
<h1>Confirm Ticket Selection</h1>
<div class="line"></div>
    
    <?php if (empty($shoppingCart)): ?>
        <p>Your shopping cart is empty.</p>
    <?php else: ?>
	
	    <p>Movie Title: <?php echo $movieInfo['title']; ?></p>
        <p>Movie Timing: <?php echo $movieInfo['timing']; ?></p>
        
        <h2>Selected Seats:</h2>
        <ul>
            <?php foreach ($shoppingCart as $seat): ?>
                <li><?php echo $seat; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
		</div>
		 <footer>
			<small>
				&copy; COPYRIGHT 2023 LUMISCREEN ORGANISATION. ALL RIGHTS RESERVED.
			</small>
			<br>
			<a href="Connect.html">
				<i>Connect with us</i>
			</a>
		</footer>
</div>
</body>
</html>