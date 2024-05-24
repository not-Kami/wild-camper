<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    die('You must be logged in to make a reservation.');
}

// Récupérer les données de la réservation depuis la session
$user_id = $_SESSION['user_id'];
$vehicle_id = $_SESSION['step2']['vehicle'];
$start_date = $_SESSION['step1']['start_date'];
$end_date = $_SESSION['step1']['end_date'];
$adults = $_SESSION['step3']['adults'];
$children = $_SESSION['step3']['children'];
$pets = isset($_SESSION['step3']['pets']) ? 1 : 0;

// Connexion à la base de données
$conn = openDatabaseConnection();

// Insérer la réservation dans la base de données
$sql = "INSERT INTO reservations (user_id, vehicle_id, start_date, end_date, adults, children, pets, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iissiii", $user_id, $vehicle_id, $start_date, $end_date, $adults, $children, $pets);

if ($stmt->execute()) {
    echo "Reservation successful!";
    // Rediriger ou afficher un message de confirmation
} else {
    echo "Error: " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Step 4</title>
    <link rel="stylesheet" href="../../public/style/global.css">
    <link rel="stylesheet" href="../../public/style/booking.css">
</head>
<body>
    <main class="booking-container">
        <h2>Review Your Booking</h2>
        <p><strong>Date:</strong> <?php echo $_SESSION['step1']['date']; ?></p>
        <p><strong>Vehicle:</strong> <?php echo $_SESSION['step2']['vehicle']; ?></p>
        <p><strong>Adults:</strong> <?php echo $_SESSION['step3']['adults']; ?></p>
        <p><strong>kids:</strong> <?php echo $_SESSION['step3']['kids']; ?></p>
        <p><strong>Pets:</strong> <?php echo $_SESSION['step3']['pets']; ?></p>

        <form action="step4.php" method="POST">
            <button type="submit">Confirm</button>
        </form>
        <form action="step1.php" method="GET">
            <button type="submit">Modify</button>
        </form>
    </main>
    <footer class
