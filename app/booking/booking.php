<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking - Wild Campers</title>
    <link rel="stylesheet" href="booking.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
<a href="javascript:history.back()" class="chevron-left"><span class="material-icons">arrow_back_ios</span></a>
<a href="../../index.php"><img src="../../public/img/wild-camper-logo.svg" alt="Wild Camper Logo" class="logo"></a>
<main class="booking-main">
    <div class="container">
        <div class="content">
            <?php
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $step = isset($_GET['step']) ? $_GET['step'] : '1';
            if (true) {
                include 'step' . $step . '.php';
                
            }
            ?>
        </div>
    </div>
</main>
<footer class="footer">
    <p class="footer-copy">© <?php echo date('Y'); ?> WildCampers. All rights reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="booking.js"></script>
</body>
</html>