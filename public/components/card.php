<?php
/**
 * Composant réutilisable unifié pour afficher une carte de véhicule
 * Peut être utilisé dans un carousel ou une grille
 * 
 * @param string $image Chemin vers l'image du véhicule
 * @param string $name Nom du véhicule
 * @param string $description Description du véhicule
 * @param string $link Lien vers la page de détails (optionnel)
 * @param string $variant Variante de la carte: 'default' ou 'carousel'
 */
if (!function_exists('renderCard')) {
    function renderCard($image, $name, $description = 'Description', $link = '#', $variant = 'default') {
        $cardClass = 'card';
        if ($variant === 'carousel') {
            $cardClass .= ' card--carousel';
        }
        ?>
        <div class="<?php echo htmlspecialchars($cardClass); ?>">
            <?php if ($variant === 'carousel'): ?>
                <div class="card-header">
                    <h3><?php echo htmlspecialchars($name); ?></h3>
                </div>
            <?php endif; ?>
            <div class="card-image">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($name); ?>">
            </div>
            <div class="card-content">
                <?php if ($variant === 'default'): ?>
                    <h3><?php echo htmlspecialchars($name); ?></h3>
                <?php endif; ?>
                <p><?php echo htmlspecialchars($description); ?></p>
                <a href="<?php echo htmlspecialchars($link); ?>" class="button button--learn-more">
                    <?php echo $variant === 'carousel' ? 'learn more' : 'Learn More'; ?>
                </a>
            </div>
        </div>
        <?php
    }
}

// Charger les véhicules depuis la base de données (seulement si pas déjà défini)
if (!isset($vehicles)) {
    require_once __DIR__ . '/../../config/database.php';
    
    $vehicles = [];
    
    // Mapping des noms de la DB vers les images
    $imageMap = [
        'Land Rover Defender' => '/img/land_rover_discovery.png',
        'Toyota Hilux' => '/img/toyota_hilux.png',
        'Mercedes Viano' => '/img/mercedes_viano.png',
        'Land Rover Discovery 4' => '/img/land_rover_discovery.png',
        'VW Caravelle' => '/img/vw_caravelle.png',
        'Jeep Wrangler' => '/img/jeep_wrangler.png',
        'Nissan Patrol' => '/img/nissan_patrol.png',
        'Dodge Ram' => '/img/dodge_ram.png',
        'Range Rover' => '/img/range_rover.png',
        'Volvo XC90' => '/img/volvo_xc90.png'
    ];
    
    if (USE_SUPABASE) {
        // Utiliser Supabase
        require_once __DIR__ . '/../../config/supabase.php';
        
        try {
            $dbVehicles = supabaseGetAll('vehicle', ['available' => 'eq.true']);
            
            foreach ($dbVehicles as $dbVehicle) {
                $image = $imageMap[$dbVehicle['name']] ?? '/img/dodge_ram.png';
                $vehicles[] = [
                    'id' => $dbVehicle['id'],
                    'image' => $image,
                    'name' => $dbVehicle['name'],
                    'description' => $dbVehicle['description'],
                    'feature' => (int)$dbVehicle['featured']
                ];
            }
        } catch (Exception $e) {
            error_log("Erreur lors du chargement des véhicules depuis Supabase: " . $e->getMessage());
            $vehicles = getFallbackVehicles($imageMap);
        }
    } else {
        // Utiliser MySQL (legacy)
        $pdo = getDBConnection();
        
        if ($pdo) {
            try {
                $stmt = $pdo->query("SELECT id, name, description, featured FROM fleet WHERE available = 1 ORDER BY id");
                $dbVehicles = $stmt->fetchAll();
                
                foreach ($dbVehicles as $dbVehicle) {
                    $image = $imageMap[$dbVehicle['name']] ?? '/img/dodge_ram.png';
                    $vehicles[] = [
                        'id' => $dbVehicle['id'],
                        'image' => $image,
                        'name' => $dbVehicle['name'],
                        'description' => $dbVehicle['description'],
                        'feature' => (int)$dbVehicle['featured']
                    ];
                }
            } catch (PDOException $e) {
                error_log("Erreur lors du chargement des véhicules: " . $e->getMessage());
                $vehicles = getFallbackVehicles($imageMap);
            }
        } else {
            $vehicles = getFallbackVehicles($imageMap);
        }
    }
}

// Fonction helper pour les données de fallback
function getFallbackVehicles($imageMap) {
    return [
        ['image' => '/img/dodge_ram.png', 'name' => 'Dodge Ram', 'description' => 'Legendary power and capability for the toughest adventures', 'feature' => 1],
        ['image' => '/img/jeep_wrangler.png', 'name' => 'Jeep Wrangler', 'description' => 'Iconic design for freedom and top performance', 'feature' => 1],
        ['image' => '/img/land_rover_discovery.png', 'name' => 'Land Rover Discovery', 'description' => 'Luxurious comfort and exceptional off-road capabilities', 'feature' => 1],
        ['image' => '/img/mercedes_viano.png', 'name' => 'Mercedes Viano', 'description' => 'Space and comfort for long journeys', 'feature' => 0],
        ['image' => '/img/nissan_patrol.png', 'name' => 'Nissan Patrol', 'description' => 'Raw power and robustness for challenging landscapes', 'feature' => 0],
        ['image' => '/img/range_rover.png', 'name' => 'Range Rover', 'description' => 'Ultimate luxury and performance', 'feature' => 0],
        ['image' => '/img/toyota_hilux.png', 'name' => 'Toyota Hilux', 'description' => 'Proven durability and reliability', 'feature' => 0],
        ['image' => '/img/volvo_xc90.png', 'name' => 'Volvo XC90', 'description' => 'Safety and sophistication combined', 'feature' => 0],
        ['image' => '/img/vw_caravelle.png', 'name' => 'Volkswagen Caravelle', 'description' => 'Perfect for family adventures', 'feature' => 0]
    ];
}
?>

