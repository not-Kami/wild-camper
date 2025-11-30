<?php
// Inclure le composant vehicle-card
include __DIR__ . '/vehicle-card.php';
?>

<section class="fleet-grid-section">
    <h2>Our Complete Fleet</h2>
    <div class="fleet-grid">
        <?php
        foreach ($vehicles as $vehicle) {
            renderVehicleCard(
                $vehicle['image'],
                $vehicle['name'],
                $vehicle['description'],
                '#'
            );
        }
        ?>
    </div>
</section>

