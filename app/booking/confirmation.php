<?php
session_start();

if (!isset($_SESSION['step1']) || !isset($_SESSION['step2']) || !isset($_SESSION['step3'])) {
    header('Location: step1.php');
    exit;
}

require_once '../config/db_connection.php';

$step1 = $_SESSION['step1'];
$step2 = $_SESSION['step2'];
$step3 = $_SESSION['step3'];

// Récupération des détails du véhicule
$stmt = $pdo->prepare('SELECT * FROM fleet WHERE id = ?');
$stmt->execute([$step1['vehicle']]);
$vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$vehicle) {
    echo "Véhicule non trouvé.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement de la confirmation de la réservation
    // Par exemple, enregistrer la réservation dans la base de données

    // Détruire les sessions pour éviter les redirections infinies
    session_destroy();

    // Réponse JSON pour la mise à jour dynamique
    echo json_encode(['status' => 'success']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/booking.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <main class="booking-main">
        <div class="booking-container">
            <h2>Confirmation de la réservation</h2>
            <div class="selected-vehicle">
                <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
                <img src="<?= htmlspecialchars($vehicle['image_path']) ?>" alt="<?= htmlspecialchars($vehicle['name']) ?>" style="width: 100%; max-width: 300px; height: auto;">
                <p>Prix : <?= htmlspecialchars($vehicle['price_per_week']) ?> € par semaine</p>
            </div>
            <div class="booking-summary">
                <h3>Résumé de la réservation</h3>
                <p>Date de début : <?= htmlspecialchars($step2['start_date']) ?></p>
                <p>Date de fin : <?= htmlspecialchars($step2['end_date']) ?></p>
                <p>Nombre d'adultes : <?= htmlspecialchars($step3['adults']) ?></p>
                <p>Nombre d'enfants : <?= htmlspecialchars($step3['kids']) ?></p>
                <p>Animaux de compagnie : <?= isset($step3['pets']) && $step3['pets'] == 'on' ? 'Oui' : 'Non' ?></p>
                <p>Total : ... €</p>
            </div>
            <button id="confirm-button">Confirmer la réservation</button>
            <div id="confirmation-message" style="display:none;">
                <p>Votre réservation a été confirmée ! Une confirmation vous sera envoyée bientôt.</p>
                <p>Vous serez redirigé vers la page d'accueil dans <span id="countdown">10</span> secondes...</p>
            </div>
        </div>
    </main>
    <p class="footer-copy">© <?= date('Y'); ?> WildCampers. Tous droits réservés.</p>
    <script>
        $(document).ready(function() {
            $('#confirm-button').click(function() {
                $.post('confirmation.php', {}, function(response) {
                    if (response.status === 'success') {
                        $('#confirmation-message').show();
                        $('#confirm-button').hide();
                        startCountdown(10, "../../index.php");
                    }
                }, 'json');
            });
        });

        function startCountdown(seconds, redirectUrl) {
            var countdownElement = document.getElementById('countdown');
            var interval = setInterval(function() {
                countdownElement.textContent = seconds;
                seconds--;
                if (seconds < 0) {
                    clearInterval(interval);
                    window.location.href = redirectUrl;
                }
            }, 1000);
        }
    </script>
</body>
</html>
