<?php
/**
 * Script de migration des données de MySQL vers Supabase
 * 
 * Ce script lit les données depuis MySQL et les insère dans Supabase via l'API REST
 * 
 * Usage: php database/supabase/migrate-data.php
 */

// Charger les configurations
$configPath = __DIR__ . '/../../config/database.php';
if (file_exists($configPath)) {
    require_once $configPath;
} else {
    // Essayer depuis la racine
    require_once __DIR__ . '/../../../config/database.php';
}

$supabasePath = __DIR__ . '/../../config/supabase.php';
if (file_exists($supabasePath)) {
    require_once $supabasePath;
} else {
    require_once __DIR__ . '/../../../config/supabase.php';
}

echo "🚀 Démarrage de la migration MySQL → Supabase\n\n";

// Connexion MySQL
$mysqlPdo = null;
if (!USE_SUPABASE) {
    $mysqlPdo = getDBConnection();
} else {
    // Forcer la connexion MySQL même si USE_SUPABASE est true
    define('DB_HOST', getenv('DB_HOST') ?: 'db');
    define('DB_NAME', getenv('DB_NAME') ?: 'wildcamper');
    define('DB_USER', getenv('DB_USER') ?: 'wildcamper');
    define('DB_PASS', getenv('DB_PASS') ?: 'wildcamper123');
    
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $mysqlPdo = new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        echo "❌ Erreur de connexion MySQL: " . $e->getMessage() . "\n";
        exit(1);
    }
}

if (!$mysqlPdo) {
    echo "❌ Impossible de se connecter à MySQL\n";
    exit(1);
}

// Vérifier la connexion Supabase
if (!USE_SUPABASE) {
    echo "⚠️  USE_SUPABASE est false. Activez Supabase pour migrer les données.\n";
    exit(1);
}

echo "✅ Connexions établies\n";
echo "📊 Début de la migration...\n\n";

$migrated = 0;
$errors = 0;

// Fonction helper pour migrer une table
function migrateTable($mysqlPdo, $tableName, $supabaseTableName, $transformCallback = null) {
    global $migrated, $errors;
    
    echo "📦 Migration de la table: $tableName → $supabaseTableName\n";
    
    try {
        // Lire depuis MySQL
        $stmt = $mysqlPdo->query("SELECT * FROM $tableName");
        $rows = $stmt->fetchAll();
        
        if (empty($rows)) {
            echo "   ⚠️  Aucune donnée à migrer\n";
            return;
        }
        
        echo "   📥 " . count($rows) . " enregistrement(s) trouvé(s)\n";
        
        // Insérer dans Supabase
        foreach ($rows as $row) {
            // Transformer les données si nécessaire
            if ($transformCallback) {
                $row = $transformCallback($row);
            }
            
            // Convertir TINYINT(1) en boolean
            if (isset($row['available'])) {
                $row['available'] = (bool)$row['available'];
            }
            
            // Supprimer les clés NULL
            $row = array_filter($row, function($value) {
                return $value !== null;
            });
            
            $result = supabaseInsert($supabaseTableName, $row, true);
            
            if ($result === false || empty($result)) {
                echo "   ❌ Erreur lors de l'insertion de l'enregistrement ID: " . ($row['id'] ?? 'N/A') . "\n";
                $errors++;
            } else {
                $migrated++;
            }
        }
        
        echo "   ✅ Migration terminée: $migrated enregistrement(s) migré(s)\n\n";
        
    } catch (Exception $e) {
        echo "   ❌ Erreur: " . $e->getMessage() . "\n\n";
        $errors++;
    }
}

// Migration des tables de référence (sans dépendances)
echo "📋 Migration des tables de référence...\n\n";

// 1. Roles
migrateTable($mysqlPdo, 'role', 'role');

// 2. Categories
migrateTable($mysqlPdo, 'category', 'category');

// 3. Languages
migrateTable($mysqlPdo, 'language', 'language');

// 4. Themes
migrateTable($mysqlPdo, 'theme', 'theme');

// 5. Tags
migrateTable($mysqlPdo, 'tag', 'tag');

// 6. Users (avec transformation du mot de passe)
migrateTable($mysqlPdo, 'user', 'user', function($row) {
    // Hasher le mot de passe s'il est en clair
    if (strlen($row['password']) < 60) {
        $row['password'] = password_hash($row['password'], PASSWORD_DEFAULT);
    }
    return $row;
});

// 7. Vehicles (fleet → vehicle)
migrateTable($mysqlPdo, 'fleet', 'vehicle', function($row) {
    // Convertir available de TINYINT(1) à boolean
    $row['available'] = (bool)$row['available'];
    return $row;
});

// 8. Vehicle tags
migrateTable($mysqlPdo, 'vehicle_tags', 'vehicle_tags');

// 9. Reviews
migrateTable($mysqlPdo, 'reviews', 'reviews');

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ Migration terminée!\n";
echo "   📊 Total migré: $migrated enregistrement(s)\n";
if ($errors > 0) {
    echo "   ⚠️  Erreurs: $errors\n";
}
echo str_repeat("=", 50) . "\n\n";

echo "🔍 Vérification des données dans Supabase...\n";
$vehicles = supabaseGetAll('vehicle', []);
echo "   ✅ " . count($vehicles) . " véhicule(s) trouvé(s) dans Supabase\n";

$users = supabaseGetAll('user', []);
echo "   ✅ " . count($users) . " utilisateur(s) trouvé(s) dans Supabase\n\n";

echo "🎉 Migration complète!\n";
?>

