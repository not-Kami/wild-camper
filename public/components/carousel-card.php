<?php
/**
 * Composant réutilisable pour une carte de carousel
 * 
 * @param string $image Chemin vers l'image du véhicule
 * @param string $name Nom du véhicule
 * @param string $description Description du véhicule
 * @param string $link Lien vers la page de détails (optionnel)
 */
if (!function_exists('renderCarouselCard')) {
    function renderCarouselCard($image, $name, $description = 'Description', $link = '#') {
        ?>
        <div class="carousel-card">
            <div class="card-header">
                <h3><?php echo htmlspecialchars($name); ?></h3>
            </div>
            <div class="card-image">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="card-content">
                <p><?php echo htmlspecialchars($description); ?></p>
                <a href="<?php echo htmlspecialchars($link); ?>" class="card-learn-more">learn more</a>
            </div>
        </div>
        <?php
    }
}
?>

