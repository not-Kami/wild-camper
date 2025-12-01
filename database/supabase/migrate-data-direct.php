<?php
/**
 * Script de migration des données de MySQL vers Supabase (via PostgreSQL direct)
 * 
 * Ce script lit les données depuis MySQL et les insère directement dans PostgreSQL
 * Plus rapide et plus simple que via l'API REST
 * 
 * Usage: php database/supabase/migrate-data-direct.php
 */

echo "🚀 Démarrage de la migration MySQL → Supabase (PostgreSQL direct)\n\n";

// Connexion MySQL
$mysqlHost = getenv('DB_HOST') ?: 'db';
$mysqlDb = getenv('DB_NAME') ?: 'wildcamper';
$mysqlUser = getenv('DB_USER') ?: 'wildcamper';
$mysqlPass = getenv('DB_PASS') ?: 'wildcamper123';

try {
    $mysqlDsn = "mysql:host=$mysqlHost;dbname=$mysqlDb;charset=utf8mb4";
    $mysqlPdo = new PDO($mysqlDsn, $mysqlUser, $mysqlPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "✅ Connexion MySQL établie\n";
} catch (PDOException $e) {
    echo "❌ Erreur de connexion MySQL: " . $e->getMessage() . "\n";
    exit(1);
}

// Connexion PostgreSQL (Supabase)
$pgHost = getenv('POSTGRES_HOST') ?: 'supabase-db';
$pgPort = getenv('POSTGRES_PORT') ?: '5432';
$pgDb = getenv('POSTGRES_DB') ?: 'postgres';
$pgUser = getenv('POSTGRES_USER') ?: 'postgres';
$pgPass = getenv('POSTGRES_PASSWORD') ?: 'your-super-secret-and-long-postgres-password';

try {
    $pgDsn = "pgsql:host=$pgHost;port=$pgPort;dbname=$pgDb";
    $pgPdo = new PDO($pgDsn, $pgUser, $pgPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    echo "✅ Connexion PostgreSQL établie\n";
} catch (PDOException $e) {
    echo "❌ Erreur de connexion PostgreSQL: " . $e->getMessage() . "\n";
    exit(1);
}

echo "📊 Début de la migration...\n\n";

$migrated = 0;
$errors = 0;

// Fonction helper pour migrer une table
function migrateTable($mysqlPdo, $pgPdo, $tableName, $pgTableName, $transformCallback = null) {
    global $migrated, $errors;
    
    echo "📦 Migration de la table: $tableName → $pgTableName\n";
    
    try {
        // Lire depuis MySQL
        $stmt = $mysqlPdo->query("SELECT * FROM $tableName");
        $rows = $stmt->fetchAll();
        
        if (empty($rows)) {
            echo "   ⚠️  Aucune donnée à migrer\n";
            return;
        }
        
        echo "   📥 " . count($rows) . " enregistrement(s) trouvé(s)\n";
        
        // Préparer l'insertion PostgreSQL
        $pgPdo->beginTransaction();
        
        foreach ($rows as $row) {
            // Transformer les données si nécessaire
            if ($transformCallback) {
                $row = $transformCallback($row);
            }
            
            // Convertir TINYINT(1) en boolean
            if (isset($row['available'])) {
                $row['available'] = (bool)$row['available'];
            }
            
            // Construire la requête INSERT
            $columns = array_keys($row);
            $placeholders = array_map(function($col) {
                return ":$col";
            }, $columns);
            
            // Échapper les noms de tables réservés (comme "user")
            $escapedTableName = ($pgTableName === 'user') ? '"user"' : $pgTableName;
            
            // Vérifier si la table a une clé primaire simple (id) ou composite
            $hasId = isset($row['id']);
            $hasCompositeKey = ($pgTableName === 'vehicle_tags' && isset($row['vehicle_id']) && isset($row['tag_id']));
            
            if ($hasId) {
                // Table avec clé primaire simple (id)
                $sql = "INSERT INTO $escapedTableName (" . implode(', ', $columns) . ") 
                        VALUES (" . implode(', ', $placeholders) . ")
                        ON CONFLICT (id) DO UPDATE SET " . 
                        implode(', ', array_map(function($col) {
                            return "$col = EXCLUDED.$col";
                        }, array_filter($columns, function($col) {
                            return $col !== 'id';
                        })));
            } elseif ($hasCompositeKey) {
                // Table avec clé primaire composite (vehicle_tags)
                $sql = "INSERT INTO $escapedTableName (" . implode(', ', $columns) . ") 
                        VALUES (" . implode(', ', $placeholders) . ")
                        ON CONFLICT (vehicle_id, tag_id) DO NOTHING";
            } else {
                // Table sans conflit (insertion simple)
                $sql = "INSERT INTO $escapedTableName (" . implode(', ', $columns) . ") 
                        VALUES (" . implode(', ', $placeholders) . ")";
            }
            
            $stmt = $pgPdo->prepare($sql);
            $stmt->execute($row);
            $migrated++;
        }
        
        $pgPdo->commit();
        echo "   ✅ Migration terminée: " . count($rows) . " enregistrement(s) migré(s)\n\n";
        
    } catch (Exception $e) {
        $pgPdo->rollBack();
        echo "   ❌ Erreur: " . $e->getMessage() . "\n\n";
        $errors++;
    }
}

// Migration des tables de référence (sans dépendances)
echo "📋 Migration des tables de référence...\n\n";

// 1. Roles
migrateTable($mysqlPdo, $pgPdo, 'role', 'role');

// 2. Categories
migrateTable($mysqlPdo, $pgPdo, 'category', 'category');

// 3. Languages
migrateTable($mysqlPdo, $pgPdo, 'language', 'language');

// 4. Themes
migrateTable($mysqlPdo, $pgPdo, 'theme', 'theme');

// 5. Tags
migrateTable($mysqlPdo, $pgPdo, 'tag', 'tag');

// 6. Users (avec transformation du mot de passe)
migrateTable($mysqlPdo, $pgPdo, 'user', 'user', function($row) {
    // Hasher le mot de passe s'il est en clair
    if (strlen($row['password']) < 60) {
        $row['password'] = password_hash($row['password'], PASSWORD_DEFAULT);
    }
    return $row;
});

// 7. Vehicles (fleet → vehicle)
migrateTable($mysqlPdo, $pgPdo, 'fleet', 'vehicle', function($row) {
    // Convertir available de TINYINT(1) à boolean
    $row['available'] = (bool)$row['available'];
    return $row;
});

// 8. Vehicle tags
migrateTable($mysqlPdo, $pgPdo, 'vehicle_tags', 'vehicle_tags');

// 9. Reviews
migrateTable($mysqlPdo, $pgPdo, 'reviews', 'reviews');

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ Migration terminée!\n";
echo "   📊 Total migré: $migrated enregistrement(s)\n";
if ($errors > 0) {
    echo "   ⚠️  Erreurs: $errors\n";
}
echo str_repeat("=", 50) . "\n\n";

echo "🔍 Vérification des données dans Supabase...\n";
try {
    $stmt = $pgPdo->query("SELECT COUNT(*) as count FROM vehicle");
    $result = $stmt->fetch();
    echo "   ✅ " . $result['count'] . " véhicule(s) trouvé(s) dans Supabase\n";
    
    $stmt = $pgPdo->query("SELECT COUNT(*) as count FROM \"user\"");
    $result = $stmt->fetch();
    echo "   ✅ " . $result['count'] . " utilisateur(s) trouvé(s) dans Supabase\n\n";
} catch (Exception $e) {
    echo "   ⚠️  Erreur lors de la vérification: " . $e->getMessage() . "\n";
}

echo "🎉 Migration complète!\n";
?>

