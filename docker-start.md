# Guide de démarrage Docker - Wild Camper

## Prérequis
- Docker Desktop installé et démarré
- Ports 8080, 8000, 8082, 54322 disponibles

## Architecture

Le projet utilise deux docker-compose séparés qui communiquent via un réseau Docker partagé :

1. **Supabase** (`supabase/docker-compose.yml`) - Base de données et API
2. **WildCamper** (`docker-compose.yml`) - Application web

## Démarrage

### 1. Démarrer Supabase (obligatoire en premier)

```bash
cd supabase
docker-compose up -d
```

Attendre que tous les services soient "healthy" (environ 30 secondes).

### 2. Démarrer l'application WildCamper

```bash
# Depuis la racine du projet
docker-compose up -d
```

### 3. (Optionnel) Démarrer MySQL legacy

Si vous avez besoin de MySQL pour compatibilité :

```bash
docker-compose --profile legacy up -d db phpmyadmin
```

## Commandes principales

### Arrêter les services
```bash
# Arrêter WildCamper
docker-compose down

# Arrêter Supabase
cd supabase && docker-compose down
```

### Voir les logs
```bash
# Logs WildCamper
docker-compose logs -f

# Logs Supabase
cd supabase && docker-compose logs -f
```

### Redémarrer les services
```bash
docker-compose restart
cd supabase && docker-compose restart
```

## Accès

### Supabase
- **Supabase Studio** (Interface admin) : http://localhost:8082
- **API REST Supabase** : http://localhost:8000
- **PostgreSQL** :
  - Host: localhost (ou `supabase-db` depuis les containers)
  - Port: 54322
  - Database: postgres
  - User: postgres
  - Password: your-super-secret-and-long-postgres-password (défini dans supabase/.env ou docker-compose.yml)

### Application
- **Site web** : http://localhost:8080
- **Login admin** : http://localhost:8080/public/login.php

### MySQL Legacy (si activé avec --profile legacy)
- **phpMyAdmin** : http://localhost:8081
- **MySQL** :
  - Host: localhost (ou `db` depuis les containers)
  - Port: 3306
  - Database: wildcamper
  - User: wildcamper
  - Password: wildcamper123

## Commandes utiles

### Accéder au shell du conteneur web
```bash
docker exec -it wild-camper-web bash
```

### Accéder au shell PostgreSQL (Supabase)
```bash
docker exec -it supabase-db psql -U postgres
```

### Accéder au shell MySQL (Legacy)
```bash
docker exec -it wild-camper-db mysql -u wildcamper -pwildcamper123 wildcamper
```

### Vérifier la communication entre containers
```bash
# Vérifier que web peut accéder à Supabase
docker exec wild-camper-web curl -s http://supabase-kong:8000/rest/v1/ | head -20
```

### Reconstruire les images
```bash
docker-compose build --no-cache
```

## Dépannage

### Supabase ne démarre pas
1. Vérifier que le réseau `supabase-network` existe : `docker network ls | grep supabase`
2. Vérifier les logs : `cd supabase && docker-compose logs`
3. Réinitialiser : `cd supabase && docker-compose down -v && docker-compose up -d`

### L'application ne peut pas se connecter à Supabase
1. Vérifier que Supabase est démarré : `cd supabase && docker-compose ps`
2. Vérifier que `wild-camper-web` est sur le réseau Supabase : `docker network inspect supabase-network`
3. Redémarrer l'application : `docker-compose restart web`

### Ports déjà utilisés
Si un port est déjà utilisé, modifiez-le dans le docker-compose.yml correspondant.
