# 🚀 Migration vers Supabase Cloud - Guide Complet

## 📋 Prérequis

1. Un compte sur [supabase.com](https://supabase.com)
2. Les données locales déjà migrées (✅ fait)

## 🔧 Étapes de Migration

### 1. Créer un Projet Supabase Cloud

1. Allez sur https://supabase.com
2. Cliquez sur "New Project"
3. Remplissez :
   - **Name** : wild-camper (ou votre choix)
   - **Database Password** : Choisissez un mot de passe fort (⚠️ notez-le !)
   - **Region** : Choisissez la plus proche
4. Cliquez sur "Create new project"
5. ⏳ Attendez 2-3 minutes que le projet soit créé

### 2. Récupérer les Clés API

Une fois le projet créé :

1. Allez dans **Settings** → **API**
2. Copiez les informations suivantes :
   - **Project URL** : `https://xxxxx.supabase.co`
   - **anon public key** : `eyJhbGc...` (longue clé JWT)
   - **service_role key** : `eyJhbGc...` (longue clé JWT, ⚠️ gardez-la secrète !)

### 3. Créer le Schéma dans Supabase Cloud

1. Dans votre projet Supabase, allez dans **SQL Editor**
2. Cliquez sur **New Query**
3. Copiez le contenu de `database/supabase/schema.sql`
4. Exécutez la requête (bouton "Run" ou Ctrl+Enter)

### 4. Migrer les Données

**Option A : Via le script d'export (recommandé)**

```bash
# Exporter les données locales
./database/supabase/migrate-to-cloud.sh

# Puis dans Supabase Cloud SQL Editor, exécutez le fichier généré
```

**Option B : Via le script de migration PHP**

1. Mettez à jour temporairement votre `.env` avec les clés Supabase Cloud
2. Exécutez :
   ```bash
   docker exec wild-camper-web php /var/www/html/database/supabase/migrate-data-direct.php
   ```

**Option C : Via pg_dump direct**

```bash
# Exporter
docker exec supabase-db pg_dump -U postgres postgres > backup.sql

# Dans Supabase Cloud, allez dans SQL Editor et exécutez le fichier
```

### 5. Configurer l'Application

Mettez à jour votre `.env` ou `docker-compose.yml` :

```env
USE_SUPABASE=true
SUPABASE_URL=https://votre-projet.supabase.co
SUPABASE_KEY=votre-anon-key-ici
SUPABASE_SERVICE_KEY=votre-service-role-key-ici
```

Ou dans `docker-compose.yml` :

```yaml
environment:
  - USE_SUPABASE=true
  - SUPABASE_URL=https://votre-projet.supabase.co
  - SUPABASE_KEY=votre-anon-key
  - SUPABASE_SERVICE_KEY=votre-service-role-key
```

### 6. Redémarrer l'Application

```bash
docker-compose restart web
```

## ✅ Vérification

1. **Dans Supabase Cloud** :
   - Allez dans **Table Editor**
   - Vous devriez voir toutes vos tables (vehicle, user, category, etc.)
   - Vérifiez que les données sont présentes

2. **Dans l'application** :
   - Visitez http://localhost:8080
   - Les véhicules devraient s'afficher
   - Testez le login : http://localhost:8080/public/login.php

## 🔐 Sécurité

- ⚠️ **Ne commitez JAMAIS** les clés API dans Git
- Utilisez un fichier `.env` (déjà dans `.gitignore`)
- La `service_role key` a tous les droits - gardez-la secrète !

## 📊 User par Défaut

Oui, Supabase Cloud crée automatiquement :
- Un utilisateur `postgres` (superuser)
- Un utilisateur `authenticator` (pour l'API)
- Des rôles `anon` et `authenticated`

Vous pouvez créer des utilisateurs via :
- **Authentication** → **Users** dans l'interface Supabase
- Ou via l'API GoTrue

## 🆘 Dépannage

### Les tables n'apparaissent pas
- Vérifiez que le schéma a bien été exécuté
- Vérifiez dans **Database** → **Tables**

### Erreur de connexion
- Vérifiez que l'URL et les clés sont correctes
- Vérifiez que le projet est actif (pas en pause)

### Les données ne s'affichent pas
- Vérifiez les politiques RLS (Row Level Security)
- Par défaut, le schéma permet la lecture publique

## 🎯 Avantages de Supabase Cloud

- ✅ Interface web complète
- ✅ Backups automatiques
- ✅ Gestion d'équipe
- ✅ Analytics
- ✅ Authentification intégrée
- ✅ Storage pour fichiers
- ✅ Real-time subscriptions

