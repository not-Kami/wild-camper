<?php
/**
 * Configuration de la base de données
 * Supporte à la fois MySQL/MariaDB (legacy) et Supabase (nouveau)
 * 
 * Pour utiliser Supabase, définissez USE_SUPABASE=true dans les variables d'environnement
 */

define('USE_SUPABASE', getenv('USE_SUPABASE') === 'true' || getenv('USE_SUPABASE') === '1');

if (USE_SUPABASE) {
    // Configuration Supabase
    require_once __DIR__ . '/supabase.php';
    
    /**
     * Fonction de compatibilité pour utiliser Supabase
     */
    function getDBConnection() {
        // Pour Supabase, on utilise l'API REST, pas de connexion PDO
        // Cette fonction retourne un objet mock pour la compatibilité
        return new class {
            public function query($sql) {
                throw new Exception("Utilisez les fonctions Supabase (supabaseGetAll, etc.) au lieu de requêtes SQL directes");
            }
            
            public function prepare($sql) {
                throw new Exception("Utilisez les fonctions Supabase (supabaseGetAll, etc.) au lieu de requêtes SQL directes");
            }
        };
    }
} else {
    // Configuration MySQL/MariaDB (legacy)
    define('DB_HOST', getenv('DB_HOST') ?: 'db');
    define('DB_NAME', getenv('DB_NAME') ?: 'wildcamper');
    define('DB_USER', getenv('DB_USER') ?: 'wildcamper');
    define('DB_PASS', getenv('DB_PASS') ?: 'wildcamper123');
    define('DB_CHARSET', 'utf8mb4');
    
    /**
     * Fonction de connexion à la base de données MySQL
     */
    function getDBConnection() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
            return $pdo;
        } catch (PDOException $e) {
            error_log("Erreur de connexion à la base de données: " . $e->getMessage());
            return null;
        }
    }
}
