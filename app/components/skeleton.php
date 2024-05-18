<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Campers - Your Ultimate Adventure Companion!</title>
    <link rel="stylesheet" href="public/style/global.css">
    
    <?php
    // Détermine le nom de la page actuelle
    $layout = [
        'home' => ['hero', 'carousel', 'contact'],
        'about' => ['presentation', 'contact'], 
        'fleet' => ['contact'], 
        'booking' => ['contact'], 
        'contact' => ['contact']
];
    
    
    if(isset($layout[$page])) {
        if ($page == 'home') {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">';
            echo '<script defer src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>';
        }

        foreach($layout[$page] as $css) {
            echo '<link rel="stylesheet" type="text/css" href="public/style/' . $css . '.css">';
        }
    }
    else {
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
            <li><a href="index.php?page=fleet">Our fleet</a></li>
            <li><a href="index.php?page=about">About us</a></li>
        </ul>
    </nav>
</header>


    <main>
        <!-- Ici, nous incluons des sections modulaires selon la page -->
            <?php 
            //include 'app/' . $page . '.php';
            foreach($layout[$page] as $component) {
                include 'app/components/' . $component . '.php';
            } ?>
    </main>

    <footer>
    <div class="footer-container">
        <div class="footer-links">
            <p>Quick Links:</p>
            <ul>
                <li>Home</li>
                <li>About Us</li>
                <li>Our Fleet</li>
                <li>Pricing</li>
                <li>Destinations & Itineraries</li>
                <li>Contact</li>
                <li>FAQs</li>
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
                <li>Terms of Service</li>
                <li>Privacy Policy</li>
            </ul>
        </div>
    </div>
    <p class="footer-copy">© 2024 WildCampers. All rights reserved.</p><div class="social-links">
        <div class="social-links">
            <a href="https://facebook.com"><img src="public/img/facebook.svg" alt="Facebook"></a>
            <a href="https://twitter.com"><img src="public/img/twitter-alt.svg" alt="Twitter"></a>
            <a href="https://instagram.com"><img src="public/img/instagram.svg" alt="Instagram"></a>
     </div>
</footer>

</body>
</html>
