<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['step1'] = [
        'adults' => $_POST['adults'],
        'kids' => $_POST['kids'],
        'pets' => isset($_POST['pets']) ? 'on' : 'off'
    ];
    header('Location: booking.php?step=2');
    exit;
}
?>
<form action="booking.php?step=1" method="POST" onsubmit="return validateForm()">
    <div class="booking-form">
        <div class="counter-row">
            <label for="adults">Adults</label>
            <div class="counter">
                <button type="button" onclick="changeCount('adults', -1)"><span class="material-icons">remove_circle</span></button>
                <input type="text" id="adults" name="adults" value="1" readonly>
                <button type="button" onclick="changeCount('adults', 1)"><span class="material-icons">add_circle</span></button>
            </div>
        </div>
        <div class="counter-row">
            <label for="kids">Kids</label>
            <div class="counter">
                <button type="button" onclick="changeCount('kids', -1)"><span class="material-icons">remove_circle</span></button>
                <input type="text" id="kids" name="kids" value="0" readonly>
                <button type="button" onclick="changeCount('kids', 1)"><span class="material-icons">add_circle</span></button>
            </div>
        </div>
        <div class="counter-row">
            <label for="pets">Pets</label>
            <div class="switch-wrapper">
                <label class="switch">
                    <input type="checkbox" id="pets" name="pets">
                    <span class="slider"></span>
                </label>
            </div>
        </div>
        <p><a href="#">Are you travelling with an assistance pet?</a></p>
        <button type="submit" class="button">Confirm</button>
    </div>
</form>
