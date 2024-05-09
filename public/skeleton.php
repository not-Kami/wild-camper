<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WildCampers - Your Ultimate Adventure Companion!</title>
    <link rel="stylesheet" href="../style/style.css"> <!-- Assure-toi que le chemin vers ton fichier CSS est correct -->
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="booking.php">Booking</a></li>
                <li><a href="pricing.php">Pricing</a></li>
                <li><a href="about_us.php">About us</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Ici, nous incluons des sections modulaires selon la page -->
        <?php if (isset($content)) echo $content; ?>
        <?php if (isset($hero)) include $hero; ?>
        <?php if (isset($featured_vehicles)) include $featured_vehicles; ?>
        <?php if (isset($contact_form)) include $contact_form; ?>
    </main>

    <footer>
        <p>Quick Links:</p>
        <ul>
            <li><a href="about_us.php">About Us</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="pricing.php">Pricing</a></li>
            <li><a href="faq.php">FAQ</a></li>
        </ul>
        <p>Contact Information: Phone: (123) 456-7890 Email: info@wildcampers.com Address: 123 Mountain Road, Canadian Wilderness</p>
        <p>&copy; 2024 WildCampers. All rights reserved.</p>
        <p>Terms of Service | Privacy Policy</p>
    </footer>
</body>
</html>
