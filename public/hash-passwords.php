<?php
/**
 * Script pour hasher les mots de passe en clair dans la base de données
 * À exécuter une seule fois pour migrer les mots de passe
 * 
 * ATTENTION: Ce script doit être supprimé après utilisation pour des raisons de sécurité
 */

require_once __DIR__ . '/../config/database.php';

$pdo = getDBConnection();

if (!$pdo) {
    die("Erreur de connexion à la base de données\n");
}

try {
    // Récupérer tous les utilisateurs
    $stmt = $pdo->query("SELECT id, username, password FROM user");
    $users = $stmt->fetchAll();
    
    $updated = 0;
    
    foreach ($users as $user) {
        // Vérifier si le mot de passe est déjà hashé
        if (!password_verify('test', $user['password']) && strlen($user['password']) < 60) {
            // Le mot de passe semble être en clair, le hasher
            $hashedPassword = password_hash($user['password'], PASSWORD_DEFAULT);
            
            $updateStmt = $pdo->prepare("UPDATE user SET password = :password WHERE id = :id");
            $updateStmt->execute([
                'password' => $hashedPassword,
                'id' => $user['id']
            ]);
            
            echo "Mot de passe hashé pour l'utilisateur: {$user['username']}\n";
            $updated++;
        } else {
            echo "Mot de passe déjà hashé pour l'utilisateur: {$user['username']}\n";
        }
    }
    
    echo "\nMigration terminée. {$updated} mot(s) de passe mis à jour.\n";
    echo "ATTENTION: Supprimez ce fichier après utilisation!\n";
    
} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage() . "\n");
}
?>

