<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Campers - Your Ultimate Adventure Companion!</title>
    <link rel="stylesheet" href="/style/global.css">
    
    <?php
    // $page et $layout sont déjà définis dans index.php
    
    if(isset($layout[$page])) {
        if ($page == 'home') {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/splide@4.0.11/dist/css/splide.min.css">';
            echo '<script defer src="https://cdn.jsdelivr.net/npm/splide@4.0.11/dist/js/splide.min.js"></script>';
        }

        foreach($layout[$page] as $css) {
            $cssFile = '/style/' . $css . '.css';
            if (file_exists(__DIR__ . '/../../style/' . $css . '.css')) {
                echo '<link rel="stylesheet" type="text/css" href="' . $cssFile . '">';
            }
        }
    }
    else {
        echo '<link rel="stylesheet" type="text/css" href="/style/404.css">';
    }
    ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Yellowtail&display=swap" rel="stylesheet">

</head>

<body>
<header>
    <a href="/index.php?page=home" class="logo-link">
        <img src="/img/wild-camper-logo.svg" alt="Wild Camper Logo" class="logo">
    </a>
    <nav>
        <ul>
            <li><a href="/index.php?page=home">Home</a></li>
            <li><a href="/index.php?page=booking">Booking</a></li>
            <li><a href="/index.php?page=fleet">Our fleet</a></li>
            <li><a href="/index.php?page=about">About us</a></li>
        </ul>
    </nav>
</header>


    <main>
        <!-- Ici, nous incluons des sections modulaires selon la page -->
            <?php 
            $pageFile = __DIR__ . '/../' . $page . '.php';
            if (file_exists($pageFile)) {
                include $pageFile;
            } else {
                include __DIR__ . '/../404.php';
            }
            ?>
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
    <p class="footer-copy">© 2024 WildCampers. All rights reserved.</p>
    <div class="social-links">
        <a href="https://facebook.com"><img src="/img/facebook.svg" alt="Facebook"></a>
        <a href="https://twitter.com"><img src="/img/twitter-alt.svg" alt="Twitter"></a>
        <a href="https://instagram.com"><img src="/img/instagram.svg" alt="Instagram"></a>
    </div>
</footer>

</body>
</html>
