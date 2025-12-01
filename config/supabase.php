<?php
/**
 * Configuration Supabase
 * 
 * Pour obtenir vos clés :
 * 1. Créez un projet sur https://supabase.com
 * 2. Allez dans Settings > API
 * 3. Copiez l'URL du projet et la clé anon (public)
 */

// Configuration Supabase/PostgREST
// Par défaut, utilise l'URL locale du container si USE_SUPABASE est activé
// Pour les opérations admin, on peut utiliser directement PostgREST (port 3000) ou Kong (port 8000)
define('SUPABASE_URL', getenv('SUPABASE_URL') ?: 'http://supabase-kong:8000');
define('SUPABASE_REST_URL', getenv('SUPABASE_REST_URL') ?: 'http://supabase-rest:3000');
define('SUPABASE_KEY', getenv('SUPABASE_KEY') ?: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZS1kZW1vIiwicm9sZSI6ImFub24iLCJleHAiOjE5ODM4MTI5OTZ9.CRXP1A7WOeoJeXxjNni43kdQwgnWNReilDMblYTn_I0');
define('SUPABASE_SERVICE_KEY', getenv('SUPABASE_SERVICE_KEY') ?: 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZS1kZW1vIiwicm9sZSI6InNlcnZpY2Vfcm9sZSIsImV4cCI6MTk4MzgxMjk5Nn0.EGIM96RAZx35lJzdJsyH-qQwv8Hdp7fsn3W0YpN81IU'); // Pour les opérations admin

/**
 * Effectue une requête à l'API REST de Supabase
 * 
 * @param string $table Nom de la table
 * @param string $method Méthode HTTP (GET, POST, PATCH, DELETE)
 * @param array $data Données à envoyer (pour POST/PATCH)
 * @param array $filters Filtres pour les requêtes GET (ex: ['id' => 'eq.1'])
 * @param bool $useServiceKey Utiliser la clé service (pour opérations admin)
 * @return array|false Résultat de la requête ou false en cas d'erreur
 */
function supabaseRequest($table, $method = 'GET', $data = [], $filters = [], $useServiceKey = false) {
    $url = SUPABASE_URL . '/rest/v1/' . $table;
    
    // Ajouter les filtres à l'URL pour les requêtes GET
    if ($method === 'GET' && !empty($filters)) {
        $queryParams = [];
        foreach ($filters as $key => $value) {
            $queryParams[] = $key . '=' . urlencode($value);
        }
        if (!empty($queryParams)) {
            $url .= '?' . implode('&', $queryParams);
        }
    }
    
    // Sélectionner la clé à utiliser
    $apiKey = $useServiceKey ? SUPABASE_SERVICE_KEY : SUPABASE_KEY;
    
    $ch = curl_init($url);
    
    $headers = [
        'apikey: ' . $apiKey,
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
        'Prefer: return=representation'
    ];
    
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ]);
    
    // Ajouter les données pour POST/PATCH
    if (in_array($method, ['POST', 'PATCH']) && !empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);
    
    if ($error) {
        error_log("Erreur cURL Supabase: " . $error);
        return false;
    }
    
    if ($httpCode >= 200 && $httpCode < 300) {
        $decoded = json_decode($response, true);
        return $decoded !== null ? $decoded : [];
    } else {
        error_log("Erreur Supabase HTTP $httpCode: " . $response);
        return false;
    }
}

/**
 * Récupère un élément par ID
 */
function supabaseGetById($table, $id) {
    $result = supabaseRequest($table, 'GET', [], ['id' => 'eq.' . $id]);
    return is_array($result) && count($result) > 0 ? $result[0] : null;
}

/**
 * Récupère tous les éléments d'une table avec filtres optionnels
 */
function supabaseGetAll($table, $filters = []) {
    return supabaseRequest($table, 'GET', [], $filters) ?: [];
}

/**
 * Insère un nouvel élément
 */
function supabaseInsert($table, $data, $useServiceKey = true) {
    return supabaseRequest($table, 'POST', $data, [], $useServiceKey);
}

/**
 * Met à jour un élément par ID
 */
function supabaseUpdate($table, $id, $data, $useServiceKey = true) {
    return supabaseRequest($table, 'PATCH', $data, ['id' => 'eq.' . $id], $useServiceKey);
}

/**
 * Supprime un élément par ID
 */
function supabaseDelete($table, $id, $useServiceKey = true) {
    return supabaseRequest($table, 'DELETE', [], ['id' => 'eq.' . $id], $useServiceKey);
}

/**
 * Authentification Supabase - Sign in avec email/password
 * Note: Supabase gère l'auth nativement, mais on peut aussi utiliser notre table user
 */
function supabaseAuth($email, $password) {
    // Pour l'instant, on utilise notre propre système d'auth avec la table user
    // Mais on pourrait migrer vers l'auth Supabase native plus tard
    return null;
}

