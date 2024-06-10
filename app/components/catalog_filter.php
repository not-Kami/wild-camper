<?php 
require '../config/db_connection.php'; // Inclure le fichier de connexion

$user_id = 1; // Remplacez par l'ID utilisateur réel ou récupérez-le dynamiquement

function fetchVehicles($pdo, $filters = null) {
    $sql = "SELECT DISTINCT fleet.* FROM fleet 
            LEFT JOIN vehicle_tag ON fleet.id = vehicle_tag.vehicle_id 
            LEFT JOIN tag ON vehicle_tag.tag_id = tag.id 
            LEFT JOIN category ON fleet.category_id = category.id 
            LEFT JOIN theme ON fleet.theme_id = theme.id 
            WHERE 1=1";
    
    $params = [];
    if ($filters) {
        if (!empty($filters['category'])) {
            $categories = explode(',', $filters['category']);
            $sql .= " AND category.id IN (" . implode(',', array_fill(0, count($categories), '?')) . ")";
            $params = array_merge($params, $categories);
        }

        if (!empty($filters['tag'])) {
            $tags = explode(',', $filters['tag']);
            $sql .= " AND tag.id IN (" . implode(',', array_fill(0, count($tags), '?')) . ")";
            $params = array_merge($params, $tags);
        }

        if (!empty($filters['theme'])) {
            $themes = explode(',', $filters['theme']);
            $sql .= " AND theme.id IN (" . implode(',', array_fill(0, count($themes), '?')) . ")";
            $params = array_merge($params, $themes);
        }
    }

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function fetchFavorites($pdo, $user_id) {
    $sql_favorites = "SELECT vehicle_id FROM user_favorite_vehicles WHERE user_id = :user_id";
    $stmt_favorites = $pdo->prepare($sql_favorites);
    $stmt_favorites->execute(['user_id' => $user_id]);
    return $stmt_favorites->fetchAll(PDO::FETCH_COLUMN);
}

// Read filters from the URL
$filters = [
    'category' => filter_input(INPUT_GET, 'category', FILTER_SANITIZE_STRING),
    'tag' => filter_input(INPUT_GET, 'tag', FILTER_SANITIZE_STRING),
    'theme' => filter_input(INPUT_GET, 'theme', FILTER_SANITIZE_STRING),
];

$vehicles = fetchVehicles($pdo, $filters);
$favorites = fetchFavorites($pdo, $user_id);

ob_start(); // Start output buffering
foreach ($vehicles as $vehicle):
    $is_favorite = in_array($vehicle['id'], $favorites);
    ?>
    <div class="vehicle-card">
        <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
        <div class="vehicle-image" style="background-image: url('<?= htmlspecialchars($vehicle['image_path']) ?>');">
            <span class="favorite-heart <?= $is_favorite ? 'favorite' : '' ?>" data-vehicle-id="<?= $vehicle['id'] ?>">&#10084;</span>
        </div>
        <div class="description">
            <p><?= htmlspecialchars($vehicle['description']) ?></p>
        </div>
        <div class="price">Starting at <?= htmlspecialchars($vehicle['price_per_week']) ?>€ per week</div>
        <div></div>
        <div class="button-container">
            <a href="index.php?page=detail&id=<?= htmlspecialchars($vehicle['id']) ?>" class="button learn-more">Learn more</a>
        </div>
    </div>
<?php endforeach;
$content = ob_get_clean(); // Get the buffered content
echo $content; // Return the content as the response
?>
