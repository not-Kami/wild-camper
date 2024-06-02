<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['step2'] = [
        'start_date' => $_POST['start-date'],
        'end_date' => $_POST['end-date']
    ];
    header('Location: booking.php?step=3');
    exit;
}
?>
<form action="booking.php?step=2" method="POST" onsubmit="return validateDateForm()">
    <div class="date-picker-wrapper">
        <label for="start-date" class="date-picker-label">Start Date</label>
        <input type="text" id="start-date" name="start-date" class="date-picker-input" required>
    </div>
    <div class="date-picker-wrapper">
        <label for="end-date" class="date-picker-label">End Date</label>
        <input type="text" id="end-date" name="end-date" class="date-picker-input" required>
    </div>
    <button type="submit" class="button">Confirm</button>
</form>
