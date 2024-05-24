<?php 
require 'app/config/db_connection.php'; // Inclure le fichier de connexion

// Récupérer les véhicules en vedette depuis la table `fleet`
try {
    $sql = "SELECT * FROM fleet WHERE featured = 1";
    $stmt = $pdo->query($sql);
    $vehicles = $stmt->fetchAll();
} catch (\PDOException $e) {
    echo 'Erreur lors de la récupération des données : ' . $e->getMessage();
    exit();
}
?>

<section class="carousel-section">
    <div id="splide" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
                <?php foreach ($vehicles as $vehicle): ?>
                    <li class="splide__slide item-card">
                        <div class="image" style="background-image: url('<?= htmlspecialchars($vehicle['image_path']) ?>');"></div>
                        <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
                        <a href="index.php?page=detail&id=<?= htmlspecialchars($vehicle['id']) ?>" class="learn-more-btn">Learn More</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Splide('#splide', {
            type   : 'loop',
            perPage: 3,
            perMove: 1,
            autoplay: true,
            interval: 02000, // Intervalle de l'autoplay en millisecondes
            gap: '1rem',  // Ajustez l'espace entre les cartes
            padding: {
                right: '1.5rem',  // Ajustez l'espace de remplissage à droite
                left : '1.5rem',  // Ajustez l'espace de remplissage à gauche
            },
            arrows: false, // Désactiver les flèches de navigation
            pagination: false, // Désactiver les indicateurs de pagination
        }).mount();
    });
</script>
