<?php 

$page = 'home';

if(isset($_GET['page'])) {
    $filename = 'app/' . $_GET['page'] . '.php';
    if(file_exists($filename)) {
        $page = $_GET['page'];
    } else {
        $page = '404';
    }
}

include 'app/components/skeleton.php';

?>