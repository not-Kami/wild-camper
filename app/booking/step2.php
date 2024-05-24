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

require_once '../config/db_connection.php';

// Récupération de l'ID du véhicule via la session
$selected_vehicle_id = $_SESSION['step1']['vehicle'];

// Récupérer les détails du véhicule sélectionné
$stmt = $pdo->prepare('SELECT * FROM fleet WHERE id = ?');
$stmt->execute([$selected_vehicle_id]);
$selected_vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$selected_vehicle) {
    echo "Véhicule non trouvé.";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <main class="booking-main">
        <a href="step1.php" class="chevron-left"><span class="material-icons">arrow_back_ios</span></a>
        <div class="booking-container">
            <div class="selected-vehicle">
                <h2><?= htmlspecialchars($selected_vehicle['name']) ?></h2>
                <img src="<?= htmlspecialchars($selected_vehicle['image_path']) ?>" alt="<?= htmlspecialchars($selected_vehicle['name']) ?>" style="width: 100%; max-width: 300px; height: auto;">
                <p>Prix : <?= htmlspecialchars($selected_vehicle['price_per_week']) ?> € par semaine</p>
            </div>
            <h2>Sélectionnez vos dates</h2>
            <div class="booking-form">
                <form action="step2.php" method="POST">
                    <input type="hidden" name="vehicle" value="<?= htmlspecialchars($selected_vehicle['id']) ?>">
                    <input type="text" id="datePicker" name="date" placeholder="Select dates" required>
                    <button type="submit">Suivant</button>
                </form>
            </div>
        </div>
    </main>
    <p class="footer-copy">© <?= date('Y'); ?> WildCampers. Tous droits réservés.</p>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#datePicker", {
                mode: "range",
                dateFormat: "m/d/Y",
                minDate: "today"
            });
        });
    </script>
</body>
</html>
