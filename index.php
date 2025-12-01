<?php 
session_start();

// Définition du layout des pages (CSS à charger)
$layout = [
    'home' => ['hero', 'carousel', 'ideas', 'contact', 'card'],
    'about' => ['contact'], 
    'fleet' => ['card', 'contact'], 
    'booking' => ['contact'], 
    'trips' => ['contact'],
    'contact' => ['contact'],
    'admin' => ['admin'],
    '404' => ['contact']
];

// Détermination de la page courante
$page = 'home';

// Si on accède à la racine sans paramètre, c'est la page home
if(isset($_GET['page']) && !empty($_GET['page'])) {
    $filename = 'public/' . $_GET['page'] . '.php';
    if(file_exists($filename)) {
        $page = $_GET['page'];
    } else {
        $page = '404';
    }
}

// Ajouter newhome au layout si nécessaire
if (!isset($layout[$page]) && $page === 'newhome') {
    $layout[$page] = [];
}

include 'public/components/skeleton.php';

?>