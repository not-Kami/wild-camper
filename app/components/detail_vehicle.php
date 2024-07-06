<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Véhicule</title>
    <link rel="stylesheet" href="path/to/your/css/file.css">
</head>
<body>
    <?php
    include __DIR__ . '/../config/db_connection.php'; // Connexion à la base de données

    // Validation de l'ID reçu via GET
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if (!$id) {
        echo "ID invalide.";
        exit;
    }

    // Récupérer les détails du véhicule, y compris la catégorie et le thème
    $query = $pdo->prepare("
        SELECT fleet.*, category.name AS category_name, theme.name AS theme_name 
        FROM fleet 
        LEFT JOIN category ON fleet.category_id = category.id 
        LEFT JOIN theme ON fleet.theme_id = theme.id 
        WHERE fleet.id = ?
    ");
    $query->execute([$id]);
    $vehicle = $query->fetch();

    if (!$vehicle) {
        echo "Détails du véhicule non trouvés.";
        exit;
    }

    // Récupérer les tags du véhicule
    $tagQuery = $pdo->prepare("
        SELECT tag.name 
        FROM tag 
        INNER JOIN vehicle_tag ON tag.id = vehicle_tag.tag_id 
        WHERE vehicle_tag.vehicle_id = ?
    ");
    $tagQuery->execute([$id]);
    $tags = $tagQuery->fetchAll(PDO::FETCH_COLUMN);
    ?>

    <div class="vehicle-detail">
        <div class="grid-item vehicle-image" style="background-image: url('<?php echo htmlspecialchars($vehicle['image_path']); ?>');"></div>
        
        <div class="grid-item">
            <h2><?php echo htmlspecialchars($vehicle['name']); ?></h2>
            <p><?php echo htmlspecialchars($vehicle['description']); ?></p>
            <p class="price">Prix : <?php echo htmlspecialchars($vehicle['price_per_week']); ?> €</p>
        </div>

        <div class="grid-item">
            <div class="specs">
                <h4>Spécifications:</h4>
                <ul>
                    <li>Année: <?php echo htmlspecialchars($vehicle['year']); ?></li>
                    <li>Transmission: <?php echo htmlspecialchars($vehicle['transmission']); ?></li>
                    <li>Carburant: <?php echo htmlspecialchars($vehicle['fuel']); ?></li>
                </ul>
            </div>
            
            <div class="category">
                <h4>Catégorie:</h4>
                <p><?php echo htmlspecialchars($vehicle['category_name']); ?></p>
            </div>
            
            <div class="theme">
                <h4>Thème:</h4>
                <p><?php echo htmlspecialchars($vehicle['theme_name']); ?></p>
            </div>
        </div>
        
        <div class="grid-item">
            <div class="tags">
                <h4>Tags:</h4>
                <ul>
                    <?php foreach ($tags as $tag): ?>
                        <li><?php echo htmlspecialchars($tag); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
            <a href="/app/booking/step2.php?id=<?php echo htmlspecialchars($vehicle['id']); ?>" class="button-alt">Book now</a>
        </div>
    </div>
</body>
</html>
