<?php
// Inclure le composant unifié
include __DIR__ . '/card.php';
?>

<section class="carousel-section">
    <div class="carousel-container">
        <?php
        // Filtrer uniquement les véhicules avec feature = 1
        $featuredVehicles = array_filter($vehicles, function($vehicle) {
            return isset($vehicle['feature']) && $vehicle['feature'] == 1;
        });
        // Réindexer le tableau après le filtre
        $featuredVehicles = array_values($featuredVehicles);
        foreach ($featuredVehicles as $vehicle) {
            renderCard(
                $vehicle['image'],
                $vehicle['name'],
                $vehicle['description'],
                '#',
                'carousel'
            );
        }
        ?>
    </div>
</section>

