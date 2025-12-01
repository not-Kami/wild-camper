# Supabase Local Setup

Ce dossier contient la configuration Docker Compose pour Supabase en local.

## Démarrage

1. **Démarrer Supabase** :
```bash
cd supabase
docker-compose up -d
```

2. **Démarrer l'application WildCamper** (depuis la racine) :
```bash
docker-compose up -d
```

## Services Supabase

- **Supabase Studio** : http://localhost:8082 (Interface d'administration)
- **API REST** : http://localhost:8000
- **PostgreSQL** : localhost:54322
- **Auth** : http://localhost:8000/auth/v1
- **REST API** : http://localhost:8000/rest/v1

## Configuration

Les services Supabase et WildCamper communiquent via le réseau Docker `supabase-network`.

L'application WildCamper peut accéder à Supabase via :
- `http://supabase-kong:8000` (depuis les containers)
- `http://localhost:8000` (depuis l'hôte)

## Variables d'environnement

Créez un fichier `.env` dans le dossier `supabase/` si vous voulez personnaliser :

```env
POSTGRES_PASSWORD=your-super-secret-and-long-postgres-password
JWT_SECRET=your-super-secret-jwt-token-with-at-least-32-characters-long
```

