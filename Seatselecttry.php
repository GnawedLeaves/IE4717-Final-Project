<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the selected seats and store them in a shopping cart session variable.
    $_SESSION['shopping_cart'] = isset($_POST['selected-seats']) ? $_POST['selected-seats'] : [];

    $_SESSION['movie_info'] = [
        'title' => 'Oppenheimer',
        // Replace with the actual movie title
        'timing' => '11:00AM',
        // Replace with the actual movie timing
    ];


    // Redirect to the shopping cart page.
    header('Location: shopping_cart.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
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
<h1>Select Your Seats</h1>
<div class="line"></div>
<div class="seating-area">
    <form method="post">
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $selectedSeats = isset($_POST['selected-seats']) ? explode(', ', $_POST['selected-seats']) : [];
    } else {
        $selectedSeats = [];
    }

    generateSeatingArea(5, 6, 'main', $selectedSeats);
    echo '<div class="selected-box">';
    echo '<p id="selected-seats">Seats Selected: ' . implode(', ', $selectedSeats) . '</p>';
    echo '<input type="hidden" name="selected-seats" id="selected-seats-input">';
    echo '<input type="submit" value="Submit">';
    echo '</div>';
    ?>
</form>

        </div>
    <div class="screen">Screen</div>
    <div class="side-seating-area">
        <form method="post">
            <?php
            generateSeatingArea(5, 6, 'side', $selectedSeats, 7);
            ?>
        </form>
    </div>
    <script>
        // JavaScript for seat selection
        const seats = document.querySelectorAll('.seat');
        const selectedSeatsDisplay = document.getElementById('selected-seats');
        const selectedSeatsInput = document.getElementById('selected-seats-input');

        seats.forEach(seat => {
            seat.addEventListener('click', () => {
                seat.classList.toggle('selected');
                updateSelectedSeatsDisplay();
                updateSelectedSeatsInput();
            });
        });
        
        function updateSelectedSeatsInput() {
        const selectedSeats = Array.from(document.querySelectorAll('.seat.selected')).map(seat => formatSeatId(seat.dataset.seatId));
        selectedSeatsInput.value = selectedSeats.join(', ');
    }

        function updateSelectedSeatsDisplay() {
            const selectedSeats = Array.from(document.querySelectorAll('.seat.selected')).map(seat => formatSeatId(seat.dataset.seatId));
            selectedSeatsDisplay.textContent = 'Seats Selected: ' + selectedSeats.join(', ');
        }

        function formatSeatId(seatId) {
            const row = String.fromCharCode(64 + parseInt(seatId.split('-')[0]));
            const column = seatId.split('-')[1];
            return row + '-' + column;
        }

        function formatSelectedSeats(selectedSeats) {
            return selectedSeats.map(seat => formatSeatId(seat)).join(', ');
        }
        

        // Initial update of selected seats display
        updateSelectedSeatsDisplay();
    </script>
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
<?php
function generateSeatingArea($numRows, $numCols, $area, $selectedSeats = [], $startColumn = 1)
{
    for ($row = 1; $row <= $numRows; $row++) {
        echo "<div class='row'>";

        // Add a row label
        echo "<div class='{$area}-row-label'>";
        echo chr(64 + $row);
        echo "</div>";

        for ($col = $startColumn; $col < $startColumn + $numCols; $col++) {
            $seatId = "$row-$col";
            $isSelected = in_array($seatId, $selectedSeats) ? 'selected' : '';
            echo "<div class='seat $isSelected' data-seat-id='$seatId'>";
            echo $col;
            echo "</div>";
        }

        echo "</div>";
    }
}
?>