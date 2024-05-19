<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Campers - Your Ultimate Adventure Companion!</title>
    <link rel="stylesheet" href="public/style/global.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php
    // Détermine le nom de la page actuelle
    $layout = [
        'home' => ['hero', 'carousel', 'contact'],
        'about' => ['presentation', 'contact'], 
        'catalog' => ['fleet', 'contact'],
        'booking' => ['contact'], 
        'contact' => ['contact'],
        'detail' => ['vehicle', 'contact'],
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
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>
<header>
    <img src="public/img/wild-camper-logo.svg" alt="Wild Camper Logo" class="logo">
    <nav>
        <ul>
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=booking">Booking</a></li>
            <li><a href="index.php?page=catalog">Our fleet</a></li>
            <li><a href="index.php?page=about">About us</a></li>
        </ul>
    </nav>
    <!-- svg de user -->
    <div class="user-profile">
        <span class="material-symbols-outlined">person</span>
    </div>
    <!-- <?php
    if (!isset($_SESSION['user'])) {
        echo '<a href="index.php?page=login" class="button">Login</a>';
    }
    ?>
    <?php   
    if (isset($_SESSION['user'])) {
        echo '<a href="index.php?page=logout" class="button">Logout</a>';
    }
    ?> -->
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

<footer>
    <div class="footer-container">
        <div class="footer-links">
            <p>Quick Links:</p>
            <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=about">About Us</a></li>
                <li><a href="index.php?page=catalog">Our Fleet</a></li>
                <li><a href="index.php?page=pricing">Pricing</a></li>
                <li><a href="index.php?page=destinations">Destinations & Itineraries</a></li>
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
    <p class="footer-copy">© 2024 WildCampers. All rights reserved.</p>
    <div class="social-links">
        <a href="https://facebook.com"><img src="public/img/facebook.svg" alt="Facebook"></a>
        <a href="https://twitter.com"><img src="public/img/twitter-alt.svg" alt="Twitter"></a>
        <a href="https://instagram.com"><img src="public/img/instagram.svg" alt="Instagram"></a>
    </div>
</footer>
</body>
</html>
