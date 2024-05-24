<?php
require 'config/db_connection.php'; // Inclure le fichier de connexion

$page = 'detail';
$vehicle_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($vehicle_id) {
    // Préparer et exécuter la requête SQL pour récupérer les détails du véhicule
    $stmt = $conn->prepare("SELECT * FROM fleet WHERE id = ?");
    $stmt->bind_param("i", $vehicle_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $vehicle = $result->fetch_assoc();
    } else {
        $vehicle = null;
    }

    $stmt->close();

    // Récupérer les avis des utilisateurs
    $reviews_stmt = $conn->prepare("SELECT * FROM reviews WHERE vehicle_id = ?");
    $reviews_stmt->bind_param("i", $vehicle_id);
    $reviews_stmt->execute();
    $reviews_result = $reviews_stmt->get_result();
    $reviews = [];

    if ($reviews_result->num_rows > 0) {
        while ($review = $reviews_result->fetch_assoc()) {
            $reviews[] = $review;
        }
    }
    $reviews_stmt->close();
} else {
    $vehicle = null;
    $reviews = [];
}

$conn->close();

// Inclure le squelette de la page
include 'components/skeleton.php';
?>

<div class="vehicle-detail">
    <?php if ($vehicle): ?>
        <div class="vehicle-photo">
            <img src="<?php echo htmlspecialchars($vehicle['image_path']); ?>" alt="<?php echo htmlspecialchars($vehicle['name']); ?>">
        </div>
        <div class="vehicle-info">
            <h1><?php echo htmlspecialchars($vehicle['name']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($vehicle['description'])); ?></p>
            <p>Price per week: $<?php echo htmlspecialchars($vehicle['price_per_week']); ?></p>
            <p>Available: <?php echo htmlspecialchars($vehicle['available']) ? 'Yes' : 'No'; ?></p>
            <form action="booking/step1.php" method="GET">
                <input type="hidden" name="vehicle_id" value="<?php echo htmlspecialchars($vehicle['id']); ?>">
                <button type="submit">Book this vehicle</button>
            </form>
        </div>
        <div class="vehicle-specs">
            <h2>Technical Details</h2>
            <p><?php echo nl2br(htmlspecialchars($vehicle['specs'])); ?></p>
        </div>
        <div class="vehicle-reviews">
            <h2>User Reviews</h2>
            <?php if (count($reviews) > 0): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="review">
                        <p><strong>Rating:</strong> <?php echo htmlspecialchars($review['rating']); ?>/5</p>
                        <p><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                        <p><small>Posted on <?php echo htmlspecialchars($review['created_at']); ?></small></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No reviews yet.</p>
            <?php endif; ?>
        </div>
        <div class="vehicle-tags">
            <h2>Tags, Theme, and Category</h2>
            <!-- Code pour afficher les tags, thèmes et catégories -->
        </div>
        <div class="similar-vehicles">
            <h2>Similar Vehicles</h2>
            <!-- Code pour afficher les véhicules similaires -->
        </div>
    <?php else: ?>
        <p>Vehicle not found.</p>
    <?php endif; ?>
</div>
