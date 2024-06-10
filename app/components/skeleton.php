<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Campers - Your Ultimate Adventure Companion!</title>
    <link rel="stylesheet" href="public/style/global.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <?php
    // Détermine le nom de la page actuelle
    $layout = [
        'home' => ['hero', 'carousel', 'contact'],
        'about' => ['introduction', 'contact'], 
        'catalog' => ['fleet', 'contact'],
        'contact' => ['contact'],
        'detail' => ['detail_vehicle', 'review','contact'],
    ];

    if (isset($layout[$page])) {
        if ($page == 'home') {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">';
            echo '<script defer src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>';
        }

        foreach ($layout[$page] as $css) {
            echo '<link rel="stylesheet" type="text/css" href="public/style/' . $css . '.css">';
        }
    } else {
        echo '<link rel="stylesheet" type="text/css" href="public/style/404.css">';
    }

    if ($page == 'booking') {
        echo '<link rel="stylesheet" type="text/css" href="public/style/booking.css">';
    }
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
<header>
    <a href="index.php"><img src="public/img/wild-camper-logo.svg" alt="Wild Camper Logo" class="logo"></a>
    <nav>
        <ul>
            <li><a href="index.php?page=home" class="nav-link" id="nav-home">Home</a></li>
            <li><a href="app/booking/booking.php" class="nav-link" id="nav-booking">Booking</a></li>
            <li><a href="index.php?page=catalog" class="nav-link" id="nav-catalog">Our fleet</a></li>
            <li><a href="index.php?page=about" class="nav-link" id="nav-about">About us</a></li>
        </ul>
    </nav>

    <div class="user-profile">
        <a href="app/login.php" class="material-symbols-outlined">person</a>
    </div>
</header>

<main>
    <!-- Inclure les sections modulaires selon la page -->
    <?php 
    if (isset($layout[$page])) {
        foreach ($layout[$page] as $component) {
            include 'app/components/' . $component . '.php';
        }
    } else {
        // Inclure le composant 404 si la page n'est pas trouvée
        include 'app/components/404.php';
    }
    ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    window.addEventListener('load', function () {
        // Obtenez l'URL actuelle
        var currentPage = window.location.href.split('page=')[1];

        // Liste des liens de navigation
        var navLinks = document.querySelectorAll('.nav-link');

        // Boucle à travers les liens et ajoutez la classe 'active' au lien correspondant
        navLinks.forEach(function (link) {
            if (link.href.includes(currentPage)) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });

        // Initialisation de Flatpickr pour le calendrier
        var datePicker = document.querySelector("#datePicker");
        if (datePicker) {
            flatpickr(datePicker, {
                dateFormat: "m/d/Y",
                minDate: "today",
                wrap: true,
                inline: false,
                theme: "dark",
            });
        }
    });
</script>

<footer>
    <div class="footer-container">
        <div class="footer-links">
            <p>Quick Links:</p>
            <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=about">About Us</a></li>
                <li><a href="index.php?page=catalog">Our Fleet</a></li>
                <li><a href="index.php?page=pricing">Pricing</a></li>
                <li><a href="app/destination.php">Destinations & Itineraries</a></li>
                <li><a href="index.php?page=contact">Contact</a></li>
                <li><a href="index.php?page=faqs">FAQs</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <p>Contact Information:</p>
            <p>Phone: 02/333 45 45 45</p>
            <p>Email: info@wildcampers.com</p>
            <p>Address: 23 Moutain road, 5555 Yukon, Canada</p>
        </div>
        <div class="footer-legal">
            <p>Legal:</p>
            <ul>
                <li><a href="index.php?page=terms">Terms of Service</a></li>
                <li><a href="index.php?page=privacy">Privacy Policy</a></li>
            </ul>
        </div>
    </div>
    <p class="footer-copy">© <?php echo date('Y'); ?> WildCampers. All rights reserved.</p>
    <div class="social-links">
        <a href="https://facebook.com"><img src="public/img/facebook.svg" alt="Facebook"></a>
        <a href="https://twitter.com"><img src="public/img/twitter-alt.svg" alt="Twitter"></a>
        <a href="https://instagram.com"><img src="public/img/instagram.svg" alt="Instagram"></a>
    </div>
</footer>
</body>
</html>
