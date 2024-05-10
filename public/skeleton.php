<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Campers - Your Ultimate Adventure Companion!</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?page=home">Home</a></li>
                <li><a href="index.php?page=booking">Booking</a></li>
                <li><a href="index.php?page=pricing">Pricing</a></li>
                <li><a href="index.php?page=about_us">About us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Ici, nous incluons des sections modulaires selon la page -->
        <?php include 'pages/' .$page'.php'; ?>
    </main>

    <footer>
        <div class="footer-content">
            <p>© 2024 WildCampers. All rights reserved.</p>
            <p>Contact Info: 123-456-7890 | info@wildcampers.com</p>
            <div class="social-links">
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
                <a href="#">Instagram</a>
                <a href="#">X</a>
            </div>
        </div>
    </footer>
</body>
</html>
