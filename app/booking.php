
    <div class="booking-container">
        <?php
        $step = isset($_GET['step']) ? intval($_GET['step']) : 1;

        switch ($step) {
            case 1:
                include 'components/booking_step1.php';
                break;
            case 2:
                include 'components/booking_step2.php';
                break;
            case 3:
                include 'components/booking_step3.php';
                break;
            default:
                include 'components/booking_step1.php';
                break;
        }
        ?>
    </div>
