<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['step1'] = $_POST;
    header('Location: step2.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Step 1</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/booking.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <main class="booking-main">
    <a href="../../index.php" class="chevron-left"><span class="material-icons">arrow_back_ios</span></a>
        <div class="booking-container">
            <div class="booking-text">
                <h3>Begin Your Adventure Today!</h3>
                <p>Ready to explore the unbeaten path? Booking your next adventure with WildCampers is just a few clicks away.</p>
            </div>
            <div class="booking-form">
                <form action="step1.php" method="POST">
                    <input type="text" id="datePicker" name="date" placeholder="Select dates" required>
                    <button type="submit">Next</button>
                </form>
            </div>
        </div>
    </main>
    <p class="footer-copy">© <?php echo date('Y'); ?> WildCampers. All rights reserved.</p>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function goBack() {
            window.history.back();
        }
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#datePicker", {
                mode: "range",
                dateFormat: "m/d/Y",
                minDate: "today"
            });
        });
    </script>
</body>
</html>
