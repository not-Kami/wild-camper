
    <div class="booking-container">
        <?php
        $step = isset($_GET['step']) ? intval($_GET['step']) : 1;

        switch ($step) {
            case 1:
                $stepFile = __DIR__ . '/components/booking_step1.php';
                if (file_exists($stepFile)) {
                    include $stepFile;
                } else {
                    echo '<p>Étape 1 de réservation - À implémenter</p>';
                }
                break;
            case 2:
                $stepFile = __DIR__ . '/components/booking_step2.php';
                if (file_exists($stepFile)) {
                    include $stepFile;
                } else {
                    echo '<p>Étape 2 de réservation - À implémenter</p>';
                }
                break;
            case 3:
                $stepFile = __DIR__ . '/components/booking_step3.php';
                if (file_exists($stepFile)) {
                    include $stepFile;
                } else {
                    echo '<p>Étape 3 de réservation - À implémenter</p>';
                }
                break;
            default:
                $stepFile = __DIR__ . '/components/booking_step1.php';
                if (file_exists($stepFile)) {
                    include $stepFile;
                } else {
                    echo '<p>Étape 1 de réservation - À implémenter</p>';
                }
                break;
        }
        ?>
    </div>
