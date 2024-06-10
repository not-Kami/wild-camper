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
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@3.6.11/dist/js/splide.min.js"></script>
<section class="carousel-section">
    <div id="splide" class="splide">
        <div class="splide__track">
            <ul class="splide__list">
            <?php foreach ($vehicles as $vehicle): ?>
                <li class="splide__slide item-card">
                    <a href="index.php?page=detail&id=<?= htmlspecialchars($vehicle['id']) ?>" class="card-link">
                        <div class="image" style="background-image: url('<?= htmlspecialchars($vehicle['image_path']) ?>');">
                            <div class="vehicle-name"><?= htmlspecialchars($vehicle['name']) ?></div>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.innerWidth > 768) { // Only initialize if screen width is greater than 768px
        new Splide('#splide', {
            type: 'loop',
            perPage: 3,
            perMove: 1,
            autoplay: true,
            interval: 2000, // Autoplay interval in milliseconds
            pauseOnHover: false, // Prevent autoplay from pausing on hover
            pauseOnFocus: false, // Prevent autoplay from pausing on focus
            resetProgress: false, // Keep the elapsed time when autoplay restarts
            arrows: false,
            pagination: false,
            gap: '20px', // Ensure the gap is defined here as well
        }).mount();
    }
});


</script>
