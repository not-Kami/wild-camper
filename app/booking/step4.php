<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include '../config/db_connection.php';

if (!isset($_SESSION['step1']) || !isset($_SESSION['step2']) || !isset($_SESSION['step3'])) {
    header('Location: booking.php?step=1');
    exit;
}

$vehicleId = $_SESSION['step3']['vehicle'];
$query = 'SELECT * FROM fleet WHERE id = ?';
$stmt = $pdo->prepare($query);
$stmt->execute([$vehicleId]);
$vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

$step1 = $_SESSION['step1'];
$step2 = $_SESSION['step2'];
$step3 = $_SESSION['step3'];
?>
<div class="booking-form-container">
    <div class="booking-summary">
        <h2>Confirmation de la réservation</h2>
        <div class="selected-vehicle">
            <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
            <img src="<?= htmlspecialchars($vehicle['image_path']) ?>" alt="<?= htmlspecialchars($vehicle['name']) ?>" style="width: 100%; max-width: 300px; height: auto;">
            <p>Prix : <?= htmlspecialchars($vehicle['price_per_week']) ?> € par semaine</p>
        </div>
        <div class="booking-details">
            <h3>Résumé de la réservation</h3>
            <p>Date de début : <?= htmlspecialchars($step2['start_date']) ?></p>
            <p>Date de fin : <?= htmlspecialchars($step2['end_date']) ?></p>
            <p>Nombre d'adultes : <?= htmlspecialchars($step1['adults']) ?></p>
            <p>Nombre d'enfants : <?= htmlspecialchars($step1['kids']) ?></p>
            <p>Animaux de compagnie : <?= isset($step1['pets']) && $step1['pets'] == 'on' ? 'Oui' : 'Non' ?></p>
            <p>Total : ... €</p>
        </div>
        <button id="confirm-button" class="button">Confirmer la réservation</button>
        <div id="confirmation-message" style="display:none;">
            <p>Votre réservation a été confirmée ! Une confirmation vous sera envoyée bientôt.</p>
            <p>Vous serez redirigé vers la page d'accueil dans <span id="countdown">10</span> secondes...</p>
        </div>
    </div>
</div>
<script>
    document.getElementById('confirm-button').addEventListener('click', function() {
        fetch('confirmation.php', {
            method: 'POST'
        }).then(response => response.json())
          .then(data => {
              if (data.status === 'success') {
                  document.getElementById('confirmation-message').style.display = 'block';
                  document.getElementById('confirm-button').style.display = 'none';
                  startCountdown(10, "../../index.php");
              }
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
