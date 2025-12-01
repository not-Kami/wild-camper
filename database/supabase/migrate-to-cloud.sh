#!/bin/bash
# Script pour exporter les données locales et les préparer pour Supabase Cloud

echo "📦 Export des données PostgreSQL locales..."

# Exporter le schéma et les données
docker exec supabase-db pg_dump -U postgres \
  --schema=public \
  --data-only \
  --column-inserts \
  postgres > supabase-cloud-data.sql

echo "✅ Données exportées dans: supabase-cloud-data.sql"
echo ""
echo "📋 Prochaines étapes:"
echo "1. Créez un projet sur https://supabase.com"
echo "2. Allez dans SQL Editor"
echo "3. Exécutez d'abord le schéma (database/supabase/schema.sql)"
echo "4. Puis exécutez ce fichier (supabase-cloud-data.sql)"
echo ""
echo "🔑 Après migration, mettez à jour votre .env avec:"
echo "   SUPABASE_URL=https://votre-projet.supabase.co"
echo "   SUPABASE_KEY=votre-anon-key"
echo "   SUPABASE_SERVICE_KEY=votre-service-role-key"

