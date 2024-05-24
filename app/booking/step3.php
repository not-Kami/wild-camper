<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['step3'] = $_POST;
    header('Location: confirmation.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Step 3</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/booking.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <main class="booking-main">
        <a href="step2.php" class="chevron-left"><span class="material-icons">arrow_back_ios</span></a>
        <div class="booking-container">
            <form action="step3.php" method="POST" onsubmit="return validateForm()">
                <div class="booking-form">
                    <div class="counter-row">
                        <label for="adults">Adults</label>
                        <div class="counter">
                            <button type="button" onclick="changeCount('adults', -1)"><span class="material-icons">remove_circle</span></button>
                            <input type="text" id="adults" name="adults" value="1" readonly>
                            <button type="button" onclick="changeCount('adults', 1)"><span class="material-icons">add_circle</span></button>
                        </div>
                    </div>
                    <div class="counter-row">
                        <label for="kids">Kids</label>
                        <div class="counter">
                            <button type="button" onclick="changeCount('kids', -1)"><span class="material-icons">remove_circle</span></button>
                            <input type="text" id="kids" name="kids" value="0" readonly>
                            <button type="button" onclick="changeCount('kids', 1)"><span class="material-icons">add_circle</span></button>
                        </div>
                    </div>
                    <div class="counter-row">
                        <label for="pets">Pets</label>
                        <label class="switch">
                            <input type="checkbox" id="pets" name="pets">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <p><a href="#">are you travelling with an assistance pet?</a></p>
                    <button type="submit">Confirm</button>
                </div>
            </form>
        </div>
    </main>
    <p class="footer-copy">© <?php echo date('Y'); ?> WildCampers. All rights reserved.</p>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function changeCount(id, delta) {
            const input = document.getElementById(id);
            const currentValue = parseInt(input.value);
            const newValue = currentValue + delta;
            const total = getTotalPeople();

            if (id === 'adults' && newValue < 1) return; // At least 1 adult
            if (id !== 'pets' && total + delta > 5) return; // Maximum 5 people excluding pets
            if (newValue < 0) return; // Prevent negative values

            input.value = newValue;
        }

        function getTotalPeople() {
            const adults = parseInt(document.getElementById('adults').value);
            const kids = parseInt(document.getElementById('kids').value);
            return adults + kids;
        }

        function validateForm() {
            const total = getTotalPeople();
            if (total < 1 || total > 5) {
                alert('Please ensure the total number of people excluding pets is between 1 and 5.');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
