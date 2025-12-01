# Guide de Migration vers Supabase

Ce guide vous explique comment migrer de MySQL/MariaDB vers Supabase.

## Avantages de Supabase

- ✅ **Authentification intégrée** : Gestion native des utilisateurs et sessions
- ✅ **API REST automatique** : Pas besoin d'écrire des endpoints manuellement
- ✅ **Interface moderne** : Dashboard intuitif pour gérer vos données
- ✅ **Row Level Security** : Sécurité au niveau des lignes
- ✅ **Temps réel** : Possibilité d'ajouter des fonctionnalités temps réel facilement
- ✅ **Gratuit** : Plan gratuit généreux pour commencer

## Étapes de Migration

### 1. Créer un projet Supabase

1. Allez sur [https://supabase.com](https://supabase.com)
2. Créez un compte (gratuit)
3. Créez un nouveau projet
4. Notez l'URL du projet et les clés API

### 2. Configurer les variables d'environnement

Créez un fichier `.env` à la racine du projet (ou modifiez `docker-compose.yml`) :

```env
USE_SUPABASE=true
SUPABASE_URL=https://votre-projet.supabase.co
SUPABASE_KEY=votre-clé-anon
SUPABASE_SERVICE_KEY=votre-clé-service-role
```

**Important** : 
- La clé `anon` (SUPABASE_KEY) est publique et peut être utilisée côté client
- La clé `service_role` (SUPABASE_SERVICE_KEY) est secrète et ne doit jamais être exposée côté client

### 3. Créer les tables dans Supabase

1. Allez dans votre projet Supabase
2. Cliquez sur "SQL Editor" dans le menu de gauche
3. Copiez le contenu de `database/supabase/schema.sql`
4. Exécutez le script SQL

Ou utilisez l'interface Table Editor pour créer les tables manuellement.

### 4. Migrer les données

#### Option A : Via l'interface Supabase
1. Allez dans "Table Editor"
2. Importez vos données via CSV ou ajoutez-les manuellement

#### Option B : Via un script PHP
Créez un script de migration (ex: `database/supabase/migrate-data.php`) qui :
1. Se connecte à MySQL
2. Lit toutes les données
3. Les insère dans Supabase via l'API

### 5. Mettre à jour le code

Le code a été préparé pour supporter les deux systèmes. Il suffit de :

1. Définir `USE_SUPABASE=true` dans les variables d'environnement
2. Les fichiers utilisent automatiquement Supabase au lieu de MySQL

### 6. Tester

1. Testez le login : `/public/login.php`
2. Testez le back office : `/public/admin.php`
3. Vérifiez que les véhicules s'affichent correctement

## Structure des fichiers

- `config/supabase.php` : Configuration et fonctions helper pour Supabase
- `config/database.php` : Configuration unifiée (MySQL ou Supabase)
- `database/supabase/schema.sql` : Schéma PostgreSQL pour Supabase
- `database/supabase/migrate-data.php` : Script de migration des données (à créer)

## Différences importantes

### MySQL vs PostgreSQL/Supabase

1. **Types de données** :
   - `TINYINT(1)` → `BOOLEAN`
   - `INT(11)` → `SERIAL` ou `INTEGER`
   - `DATETIME` → `TIMESTAMP`

2. **Guillemets** :
   - MySQL : backticks pour les noms de tables
   - PostgreSQL : guillemets doubles pour les noms réservés (comme `user`)

3. **Auto-increment** :
   - MySQL : `AUTO_INCREMENT`
   - PostgreSQL : `SERIAL` ou `GENERATED ALWAYS AS IDENTITY`

4. **Requêtes** :
   - MySQL : Requêtes SQL directes avec PDO
   - Supabase : API REST (plus simple et moderne)

## Utilisation de l'API Supabase

### Exemples

```php
// Récupérer tous les véhicules
$vehicles = supabaseGetAll('fleet', ['available' => 'eq.true']);

// Récupérer un véhicule par ID
$vehicle = supabaseGetById('fleet', 1);

// Ajouter un véhicule
$newVehicle = supabaseInsert('fleet', [
    'name' => 'Nouveau véhicule',
    'description' => 'Description',
    'price_per_week' => 1000.00,
    'available' => true,
    'featured' => 0
]);

// Mettre à jour un véhicule
supabaseUpdate('fleet', 1, ['featured' => 1]);

// Supprimer un véhicule
supabaseDelete('fleet', 1);
```

## Sécurité (Row Level Security)

Supabase utilise Row Level Security (RLS) pour sécuriser les données. Par défaut, le schéma permet la lecture publique. Pour sécuriser :

1. Allez dans "Authentication" > "Policies"
2. Créez des politiques personnalisées selon vos besoins
3. Exemple : Seuls les admins peuvent modifier les véhicules

## Authentification Supabase (Optionnel)

Supabase offre aussi un système d'authentification intégré. Vous pouvez :

1. Utiliser l'auth Supabase native (plus simple)
2. Continuer avec votre système actuel (table `user`)

Pour migrer vers l'auth Supabase :
- Utilisez le SDK JavaScript ou l'API REST
- Les utilisateurs seront dans la table `auth.users` de Supabase
- Plus besoin de gérer les mots de passe manuellement

## Rollback

Si vous voulez revenir à MySQL :

1. Définissez `USE_SUPABASE=false` dans les variables d'environnement
2. Redémarrez les conteneurs Docker
3. Le système utilisera automatiquement MySQL

## Support

- Documentation Supabase : https://supabase.com/docs
- API Reference : https://supabase.com/docs/reference/javascript/introduction
- Community : https://github.com/supabase/supabase/discussions

