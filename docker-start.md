# Guide de démarrage Docker - Wild Camper

## Prérequis
- Docker Desktop installé et démarré
- Ports 8080, 3306 et 8081 disponibles

## Commandes principales

### Démarrer les conteneurs
```bash
docker-compose up -d
```

### Arrêter les conteneurs
```bash
docker-compose down
```

### Voir les logs
```bash
docker-compose logs -f
```

### Redémarrer les services
```bash
docker-compose restart
```

### Accès
- **Site web** : http://localhost:8080
- **phpMyAdmin** : http://localhost:8081
- **Base de données** :
  - Host: localhost (ou `db` depuis le conteneur web)
  - Port: 3306
  - Database: wildcamper
  - User: wildcamper
  - Password: wildcamper123
  - Root password: rootpassword

## Commandes utiles

### Accéder au shell du conteneur web
```bash
docker exec -it wild-camper-web bash
```

### Accéder au shell MySQL
```bash
docker exec -it wild-camper-db mysql -u wildcamper -pwildcamper123 wildcamper
```

### Reconstruire les images
```bash
docker-compose build --no-cache
```

