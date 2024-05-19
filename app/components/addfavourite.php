<?php
require 'app/config/db_connection.php'; // Inclure le fichier de connexion

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $data['user_id'];
$vehicle_id = $data['vehicle_id'];

// Vérifiez si le véhicule est déjà favori
$query = $pdo->prepare("SELECT * FROM user_favorite_vehicles WHERE user_id = :user_id AND vehicle_id = :vehicle_id");
$query->execute(['user_id' => $user_id, 'vehicle_id' => $vehicle_id]);
$favorite = $query->fetch();

if ($favorite) {
    // Si le véhicule est déjà favori, le supprimer
    $delete = $pdo->prepare("DELETE FROM user_favorite_vehicles WHERE user_id = :user_id AND vehicle_id = :vehicle_id");
    $delete->execute(['user_id' => $user_id, 'vehicle_id' => $vehicle_id]);
    echo json_encode(['success' => true, 'message' => 'Vehicle removed from favorites']);
} else {
    // Si le véhicule n'est pas encore favori, l'ajouter
    $insert = $pdo->prepare("INSERT INTO user_favorite_vehicles (user_id, vehicle_id) VALUES (:user_id, :vehicle_id)");
    $insert->execute(['user_id' => $user_id, 'vehicle_id' => $vehicle_id]);
    echo json_encode(['success' => true, 'message' => 'Vehicle added to favorites']);
}
?>
