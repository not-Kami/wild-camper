<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['step1'] = $_POST;
    header('Location: step2.php');
    exit;
}

require_once '../config/db_connection.php';

// Requête pour récupérer les véhicules
$stmt = $pdo->query('SELECT * FROM fleet');
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Step 1</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/booking.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <main class="booking-main">
        <div class="booking-container">
            <h2>Select Your Vehicle</h2>
            <p>Please choose your preferred vehicle for the adventure:</p>
            <form action="step1.php" method="POST">
                <?php foreach ($vehicles as $vehicle): ?>
                    <div class="vehicle-card">
                    <img src="/<?= htmlspecialchars($vehicle['image_path']) ?>" alt="<?= htmlspecialchars($vehicle['name']) ?>">
                        <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
                        <input type="radio" name="vehicle" value="<?= htmlspecialchars($vehicle['id']) ?>" <?= $vehicle['available'] == 0 ? 'disabled' : '' ?>>
                        <label><?= $vehicle['available'] == 0 ? 'Not Available' : 'Select' ?></label>
                    </div>
                <?php endforeach; ?>
                <button type="submit">Next</button>
            </form>
        </div>
    </main>
    <p class="footer-copy">© <?= date('Y'); ?> WildCampers. All rights reserved.</p>
</body>
</html>
