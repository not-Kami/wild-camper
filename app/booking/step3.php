<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['step3'] = [
        'vehicle' => $_POST['vehicle']
    ];
    header('Location: booking.php?step=4');
    exit;
}

include '../config/db_connection.php';

$query = 'SELECT id, name, price_per_week, description, image_path, available FROM fleet';
$stmt = $pdo->prepare($query);
$stmt->execute();
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="vehicle-form-container">
    <div class="vehicle-image-container">
        <img id="vehicle-image" alt="Vehicle Image" src="">
    </div>
    <div class="vehicle-form-wrapper">
        <form action="booking.php?step=3" method="POST">
            <div class="booking-form">
                <label for="vehicle" class="date-picker-label">Choose a your ride</label>
                <select id="vehicle" name="vehicle" class="date-picker-input" required onchange="updateVehicleInfo()">
                    <?php foreach ($vehicles as $vehicle): ?>
                        <option value="<?= $vehicle['id'] ?>" data-name="<?= htmlspecialchars($vehicle['name']) ?>" data-price="<?= $vehicle['price_per_week'] ?>" data-description="<?= htmlspecialchars($vehicle['description']) ?>" data-image="<?= htmlspecialchars($vehicle['image_path']) ?>" <?= $vehicle['available'] == 0 ? 'disabled' : '' ?>>
                            <?= htmlspecialchars($vehicle['name']) ?> <?= $vehicle['available'] == 0 ? '(Not Available)' : '' ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div id="vehicle-info" class="vehicle-info">
                    <h3 id="vehicle-name"></h3>
                    <p id="vehicle-description"></p>
                </div>
                <button type="submit" class="button">Confirm</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateVehicleInfo() {
        const select = document.getElementById('vehicle');
        const selectedOption = select.options[select.selectedIndex];
        const name = selectedOption.getAttribute('data-name');
        const description = selectedOption.getAttribute('data-description');
        const image = selectedOption.getAttribute('data-image');

        const vehicleName = document.getElementById('vehicle-name');
        const vehicleDescription = document.getElementById('vehicle-description');
        const vehicleImage = document.getElementById('vehicle-image');

        if (vehicleName && vehicleDescription && vehicleImage) {
            vehicleName.textContent = name;
            vehicleDescription.textContent = description;
            vehicleImage.src = "../" + image;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateVehicleInfo(); // Update info for the initial selection
    });
</script>
