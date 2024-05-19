<?php 
require 'app/config/db_connection.php'; // Inclure le fichier de connexion

$user_id = 1; // Remplacez par l'ID utilisateur réel ou récupérez-le dynamiquement

// Récupérer les données des véhicules depuis la table `fleet`
try {
    $sql = "SELECT * FROM fleet";
    $stmt = $pdo->query($sql);
    $vehicles = $stmt->fetchAll();
} catch (\PDOException $e) {
    echo 'Erreur lors de la récupération des données : ' . $e->getMessage();
    exit();
}

// Récupérer les favoris de l'utilisateur
try {
    $sql_favorites = "SELECT vehicle_id FROM user_favorite_vehicles WHERE user_id = :user_id";
    $stmt_favorites = $pdo->prepare($sql_favorites);
    $stmt_favorites->execute(['user_id' => $user_id]);
    $favorites = $stmt_favorites->fetchAll(PDO::FETCH_COLUMN);
} catch (\PDOException $e) {
    echo 'Erreur lors de la récupération des favoris : ' . $e->getMessage();
    exit();
}
?>

<h2>Liste des Véhicules</h2>
<div class="vehicle-container">
    <?php foreach ($vehicles as $vehicle): ?>
        <?php $is_favorite = in_array($vehicle['id'], $favorites); ?>
        <div class="vehicle-card">
            <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
            <div class="vehicle-image" style="background-image: url('<?= htmlspecialchars($vehicle['image_path']) ?>');">
                <span class="favorite-heart <?= $is_favorite ? 'favorite' : '' ?>" data-vehicle-id="<?= $vehicle['id'] ?>">&#10084;</span>
            </div>
            <div class="description">
                <p><?= htmlspecialchars($vehicle['description']) ?></p>
            </div>
            <div class="price">Starting at <?= htmlspecialchars($vehicle['price_per_week']) ?>€ per week</div>
            <div class="button-container">
                <a href="#" class="button learn-more">Learn more</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteHearts = document.querySelectorAll('.favorite-heart');
    favoriteHearts.forEach(heart => {
        heart.addEventListener('click', function() {
            const vehicleId = this.dataset.vehicleId;
            const userId = '1'; // Remplacez par l'ID utilisateur réel ou récupérez-le dynamiquement

            fetch('add_favorite.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ user_id: userId, vehicle_id: vehicleId }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.classList.toggle('favorite'); // Ajoute ou enlève la classe 'favorite' pour changer la couleur
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>
