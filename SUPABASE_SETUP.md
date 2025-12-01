# Configuration Supabase - Guide Complet

## 📊 État Actuel

✅ **Les tables existent bien dans PostgreSQL local !**
- 10 tables créées et migrées
- Données présentes (9 véhicules, 11 utilisateurs, etc.)

## 🎯 Deux Options pour Accéder à Supabase

### Option 1 : Supabase Local (Docker) - Déjà Configuré ✅

**Avantages :**
- Gratuit, pas de limite
- Données locales (sécurisé)
- Développement rapide

**Accès :**
- **Supabase Studio** : http://localhost:8082
- **API REST** : http://localhost:8000
- **PostgreSQL** : localhost:54322

**Connexion PostgreSQL :**
```
Host: localhost
Port: 54322
Database: postgres
User: postgres
Password: your-super-secret-and-long-postgres-password
```

**Vérifier les tables :**
```bash
docker exec supabase-db psql -U postgres -c "\dt"
```

### Option 2 : Supabase Cloud (supabase.com) - À Configurer

**Avantages :**
- Interface web complète
- Gestion d'équipe
- Backups automatiques
- Déploiement facile

**Étapes :**

1. **Créer un compte sur https://supabase.com**
2. **Créer un nouveau projet**
   - Choisir une région
   - Définir un mot de passe pour la base de données
3. **Récupérer les clés API**
   - Settings → API
   - Copier :
     - Project URL
     - anon/public key
     - service_role key
4. **Migrer les données vers Supabase Cloud**
   - Utiliser le script de migration
   - Ou exporter/importer via pg_dump

**Configuration pour Supabase Cloud :**

Mettre à jour `.env` ou `docker-compose.yml` :

```env
USE_SUPABASE=true
SUPABASE_URL=https://votre-projet.supabase.co
SUPABASE_KEY=votre-anon-key
SUPABASE_SERVICE_KEY=votre-service-role-key
```

## 🔍 Vérification des Tables

### Via PostgreSQL direct (local)
```bash
docker exec supabase-db psql -U postgres -c "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name;"
```

### Via API REST (local)
```bash
curl http://localhost:8000/rest/v1/vehicle?select=* \
  -H "apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZS1kZW1vIiwicm9sZSI6ImFub24iLCJleHAiOjE5ODM4MTI5OTZ9.CRXP1A7WOeoJeXxjNni43kdQwgnWNReilDMblYTn_I0"
```

### Via Supabase Studio (local)
1. Ouvrir http://localhost:8082
2. Se connecter (si nécessaire)
3. Naviguer vers "Table Editor"

## 🚀 Migration vers Supabase Cloud (si souhaité)

Si vous voulez migrer vers Supabase Cloud :

1. **Créer le projet sur supabase.com**
2. **Exporter les données locales :**
   ```bash
   docker exec supabase-db pg_dump -U postgres postgres > supabase-backup.sql
   ```
3. **Importer dans Supabase Cloud :**
   - Via l'interface SQL Editor
   - Ou via `psql` avec la connexion fournie par Supabase

## 📝 Notes Importantes

- **User par défaut** : Oui, il y a un utilisateur `postgres` avec le mot de passe défini dans les variables d'environnement
- **Tables** : Toutes les tables sont dans le schéma `public`
- **RLS (Row Level Security)** : Activé mais avec des politiques publiques pour l'instant

## 🔧 Dépannage

### Supabase Studio ne montre pas les tables
1. Vérifier que les tables existent : `docker exec supabase-db psql -U postgres -c "\dt"`
2. Redémarrer Studio : `cd supabase && docker-compose restart supabase-studio`
3. Vérifier les logs : `docker logs supabase-studio`

### Connexion impossible
1. Vérifier que les services sont démarrés : `cd supabase && docker-compose ps`
2. Vérifier le réseau : `docker network inspect supabase-network`

