# ✅ Migration MySQL → Supabase - TERMINÉE

## Résumé

La migration des données de MySQL vers Supabase a été effectuée avec succès le **1er décembre 2025**.

## Données migrées

- ✅ **2** rôles
- ✅ **5** catégories
- ✅ **5** langues
- ✅ **5** thèmes
- ✅ **15** tags
- ✅ **11** utilisateurs (mots de passe hashés)
- ✅ **9** véhicules (fleet → vehicle)
- ✅ **18** relations vehicle_tags
- ✅ **3** avis (reviews)

**Total : 73 enregistrements migrés**

## Scripts de migration

Deux scripts de migration sont disponibles :

1. **`database/supabase/migrate-data-direct.php`** (recommandé)
   - Migration directe via PostgreSQL
   - Plus rapide et plus fiable
   - ✅ Utilisé avec succès

2. **`database/supabase/migrate-data.php`** (alternative)
   - Migration via l'API REST Supabase
   - Nécessite une configuration JWT correcte

## Vérification

Pour vérifier que les données sont bien dans Supabase :

```bash
# Via Supabase Studio
http://localhost:8082

# Via PostgreSQL direct
docker exec supabase-db psql -U postgres -c "SELECT COUNT(*) FROM vehicle;"
docker exec supabase-db psql -U postgres -c "SELECT COUNT(*) FROM \"user\";"
```

## Prochaines étapes

1. ✅ **Migration terminée** - Toutes les données sont dans Supabase
2. ✅ **Application configurée** - `USE_SUPABASE=true` est activé
3. ⚠️ **MySQL legacy** - Peut être supprimé ou gardé en profile `legacy` pour compatibilité

## Nettoyage (optionnel)

Si vous souhaitez supprimer complètement MySQL :

```bash
# Arrêter et supprimer les services MySQL
docker-compose --profile legacy down

# Supprimer les volumes (ATTENTION : perte de données)
docker volume rm wild-camper_db_data
```

Ou garder MySQL en profile `legacy` pour compatibilité :

```bash
# MySQL ne démarre plus par défaut
# Pour le démarrer si besoin :
docker-compose --profile legacy up -d db phpmyadmin
```

## Configuration actuelle

- **Base de données principale** : Supabase (PostgreSQL)
- **API** : Supabase REST API via Kong (port 8000)
- **Interface admin** : Supabase Studio (port 8082)
- **MySQL** : Disponible en profile `legacy` (optionnel)

