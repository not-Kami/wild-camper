<?php
include __DIR__ . '/../config/db_connection.php'; // Connexion à la base de données

// Validation de l'ID reçu via GET
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    echo "ID invalide.";
    exit;
}

// Récupérer les détails du véhicule
$query = $pdo->prepare("SELECT * FROM fleet WHERE id = ?");
$query->execute([$id]);
$vehicle = $query->fetch();

if (!$vehicle) {
    echo "Détails du véhicule non trouvés.";
    exit;
}
?>

<div class="vehicle-detail">
    <h1><?php echo htmlspecialchars($vehicle['name']); ?></h1>
    <p><?php echo htmlspecialchars($vehicle['description']); ?></p>
    <p>Prix : <?php echo htmlspecialchars($vehicle['price_per_week']); ?> €</p>
    <a href="http://dev.wild-camper.com/app/booking/step2.php?id=<?php echo htmlspecialchars($vehicle['id']); ?>" class="button">Réserver</a>
    <div class="vehicle-image" style="background-image: url('<?php echo htmlspecialchars($vehicle['image_path']); ?>');"></div>
    <div>
        <!--afficher les specs du véhicule-->
        <h4>
            Spécifications:
        </h4>
        <ul>
            <li>Capacité: <?php echo htmlspecialchars($vehicle['capacity']); ?></li>
            <li>Année: <?php echo htmlspecialchars($vehicle['year']); ?></li>
            <li>Transmission: <?php echo htmlspecialchars($vehicle['transmission']); ?></li>
            <li>Carburant: <?php echo htmlspecialchars($vehicle['fuel']); ?></li>
    </div>
    <a href="/app/booking/step2.php?id=<?php echo $vehicle['id']; ?>" class="button">Réserver</a>
    <!-- Ajoutez d'autres détails comme vous le souhaitez -->
</div>
