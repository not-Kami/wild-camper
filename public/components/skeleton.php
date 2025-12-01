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
    <script>
        // Menu burger toggle
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const nav = document.querySelector('.main-nav');
            
            if (menuToggle && nav) {
                menuToggle.addEventListener('click', function() {
                    nav.classList.toggle('nav-open');
                    menuToggle.classList.toggle('active');
                });
                
                // Close menu when clicking on a link
                const navLinks = nav.querySelectorAll('a');
                navLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        nav.classList.remove('nav-open');
                        menuToggle.classList.remove('active');
                    });
                });
            }
        });
    </script>
</head>

<body>
<header>
    <a href="/index.php?page=home" class="logo-link">
        <img src="/img/wild-camper-logo.svg" alt="Wild Camper Logo" class="logo">
    </a>
    <button class="menu-toggle" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <nav class="main-nav">
        <ul>
            <li><a href="/index.php?page=home">Home</a></li>
            <li><a href="/index.php?page=booking">Booking</a></li>
            <li><a href="/index.php?page=fleet">Our fleet</a></li>
            <li><a href="/index.php?page=trips">Voyages</a></li>
            <li><a href="/index.php?page=about">About us</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    echo '<li><a href="/public/admin.php">Back Office</a></li>';
                }
                echo '<li><a href="/public/logout.php">Déconnexion</a></li>';
            } else {
                echo '<li><a href="/public/login.php">Connexion</a></li>';
            }
            ?>
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
                <li><a href="/index.php?page=home">Home</a></li>
                <li><a href="/index.php?page=about">About Us</a></li>
                <li><a href="/index.php?page=fleet">Our Fleet</a></li>
                <li><a href="/index.php?page=booking">Pricing</a></li>
                <li><a href="/index.php?page=trips">Destinations & Itineraries</a></li>
                <li><a href="/index.php?page=contact">Contact</a></li>
                <li><a href="/index.php?page=about#faq">FAQs</a></li>
            </ul>
        </div>
        <div class="footer-contact">
            <p>Contact Information:</p>
            <p><a href="tel:+322333454545">Phone: 02/333 45 45 45</a></p>
            <p><a href="mailto:info@wildcampers.com">Email: info@wildcampers.com</a></p>
            <p>Address: 23 Moutain road, 5555 Yukon, Canada</p>
        </div>
        <div class="footer-legal">
            <p>Legal:</p>
            <ul>
                <li><a href="/index.php?page=about#terms">Terms of Service</a></li>
                <li><a href="/index.php?page=about#privacy">Privacy Policy</a></li>
            </ul>
        </div>
    </div>
    <p class="footer-copy">© 2024 WildCampers. All rights reserved.</p>
    <div class="social-links">
        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer"><img src="/img/facebook.svg" alt="Facebook"></a>
        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer"><img src="/img/twitter-alt.svg" alt="Twitter"></a>
        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer"><img src="/img/instagram.svg" alt="Instagram"></a>
    </div>
</footer>

</body>
</html>
