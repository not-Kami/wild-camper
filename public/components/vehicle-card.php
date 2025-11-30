<?php
/**
 * Composant réutilisable pour afficher une carte de véhicule
 * 
 * @param string $image Chemin vers l'image du véhicule
 * @param string $name Nom du véhicule
 * @param string $description Description du véhicule
 * @param string $link Lien vers la page de détails (optionnel)
 */
if (!function_exists('renderVehicleCard')) {
    function renderVehicleCard($image, $name, $description = 'Description', $link = '#') {
    ?>
    <div class="vehicle-card">
        <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>">
        <div class="vehicle-card-content">
            <h3><?php echo htmlspecialchars($name); ?></h3>
            <p><?php echo htmlspecialchars($description); ?></p>
            <a href="<?php echo htmlspecialchars($link); ?>" class="learn-more">Learn More</a>
        </div>
    </div>
    <?php
    }
}

// Données des véhicules (seulement si pas déjà défini)
if (!isset($vehicles)) {
$vehicles = [
    ['image' => '/img/dodge_ram.png', 'name' => 'Dodge Ram', 'description' => 'Legendary power and capability for the toughest adventures'],
    ['image' => '/img/jeep_wrangler.png', 'name' => 'Jeep Wrangler', 'description' => 'Iconic design for freedom and top performance'],
    ['image' => '/img/land_rover_discovery.png', 'name' => 'Land Rover Discovery', 'description' => 'Luxurious comfort and exceptional off-road capabilities'],
    ['image' => '/img/mercedes_viano.png', 'name' => 'Mercedes Viano', 'description' => 'Space and comfort for long journeys'],
    ['image' => '/img/nissan_patrol.png', 'name' => 'Nissan Patrol', 'description' => 'Raw power and robustness for challenging landscapes'],
    ['image' => '/img/range_rover.png', 'name' => 'Range Rover', 'description' => 'Ultimate luxury and performance'],
    ['image' => '/img/toyota_hilux.png', 'name' => 'Toyota Hilux', 'description' => 'Proven durability and reliability'],
    ['image' => '/img/volvo_xc90.png', 'name' => 'Volvo XC90', 'description' => 'Safety and sophistication combined'],
    ['image' => '/img/vw_caravelle.png', 'name' => 'Volkswagen Caravelle', 'description' => 'Perfect for family adventures']
];
}
?>