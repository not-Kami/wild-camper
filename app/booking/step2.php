<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['step2'] = $_POST;
    header('Location: step3.php');
    exit;
}

if (!isset($_SESSION['step1'])) {
    header('Location: step1.php');
    exit;
}

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=wildcamper', 'admin', 'F0aLKtE*l@NYLKzW');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les véhicules
    $stmt = $pdo->query('SELECT * FROM fleet');
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Step 2</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/booking.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <main class="booking-main">
    <a href="step1.php" class="chevron-left"><span class="material-icons">arrow_back_ios</span></a>
        <div class="booking-container">
            <h2>Select Your Vehicle</h2>
            <p>Please choose your preferred vehicle for the adventure:</p>
            <form action="step2.php" method="POST">
                <select name="vehicle" required>
                    <option value="">Select a vehicle</option>
                    <?php foreach ($vehicles as $vehicle): ?>
                        <option value="<?= htmlspecialchars($vehicle['id']) ?>" <?= $vehicle['available'] == 0 ? 'disabled' : '' ?>>
                            <?= htmlspecialchars($vehicle['name']) ?> 
                            <?= $vehicle['available'] == 0 ? ' - Not Available' : '' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Next</button>
            </form>
        </div>
    </main>
    <p class="footer-copy">© <?php echo date('Y'); ?> WildCampers. All rights reserved.</p>
</body>
</html>
