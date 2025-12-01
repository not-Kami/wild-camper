<?php
session_start();
require_once __DIR__ . '/../config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (!empty($username) && !empty($password)) {
        $pdo = getDBConnection();
        
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("
                    SELECT u.id, u.username, u.email, u.password, u.role_id, r.name as role_name 
                    FROM user u 
                    JOIN role r ON u.role_id = r.id 
                    WHERE u.username = :username
                ");
                $stmt->execute(['username' => $username]);
                $user = $stmt->fetch();
                
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role_name'];
                    
                    // Mettre à jour la dernière connexion
                    $updateStmt = $pdo->prepare("UPDATE user SET last_connection = NOW() WHERE id = :id");
                    $updateStmt->execute(['id' => $user['id']]);
                    
                    // Rediriger vers le back office si admin, sinon vers la page d'accueil
                    if ($user['role_name'] === 'admin') {
                        header('Location: /public/admin.php');
                        exit;
                    } else {
                        header('Location: /index.php?page=home');
                        exit;
                    }
                } else {
                    // Vérifier si le mot de passe est en clair (pour migration)
                    if ($user && $user['password'] === $password) {
                        // Hasher le mot de passe et mettre à jour
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                        $updateStmt = $pdo->prepare("UPDATE user SET password = :password WHERE id = :id");
                        $updateStmt->execute(['password' => $hashedPassword, 'id' => $user['id']]);
                        
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['role'] = $user['role_name'];
                        
                        if ($user['role_name'] === 'admin') {
                            header('Location: /public/admin.php');
                            exit;
                        } else {
                            header('Location: /index.php?page=home');
                            exit;
                        }
                    } else {
                        $error = 'Nom d\'utilisateur ou mot de passe incorrect';
                    }
                }
            } catch (PDOException $e) {
                error_log("Erreur de connexion: " . $e->getMessage());
                $error = 'Erreur de connexion. Veuillez réessayer.';
            }
        } else {
            $error = 'Erreur de connexion à la base de données.';
        }
    } else {
        $error = 'Veuillez remplir tous les champs';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WildCampers</title>
    <link rel="stylesheet" href="/style/global.css">
    <link rel="stylesheet" href="/style/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <img src="/img/wild-camper-logo.svg" alt="WildCampers Logo" class="login-logo">
                <h1>Connexion</h1>
            </div>
            
            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST" action="" class="login-form">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="button button--primary">Se connecter</button>
            </form>
            
            <div class="login-footer">
                <a href="/index.php?page=home">Retour à l'accueil</a>
            </div>
        </div>
    </div>
</body>
</html>

