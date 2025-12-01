<?php
// Inclure le composant unifié
include __DIR__ . '/card.php';
?>

<section class="fleet-grid-section">
    <h2>Our Complete Fleet</h2>
    <div class="fleet-grid">
        <?php
        foreach ($vehicles as $vehicle) {
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

