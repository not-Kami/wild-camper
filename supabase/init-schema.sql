-- Script d'initialisation pour Supabase
-- Crée les extensions et rôles nécessaires

-- Extensions
CREATE EXTENSION IF NOT EXISTS "uuid-ossp";
CREATE EXTENSION IF NOT EXISTS "pgcrypto";

-- Schéma auth (nécessaire pour GoTrue)
CREATE SCHEMA IF NOT EXISTS auth;

-- Variables d'environnement (utilisées par docker-compose)
-- POSTGRES_PASSWORD est utilisé comme mot de passe pour tous les rôles

-- Rôles Supabase avec mots de passe
DO $$
DECLARE
    db_password TEXT := 'your-super-secret-and-long-postgres-password';
BEGIN
    -- Rôle admin Supabase
    IF NOT EXISTS (SELECT FROM pg_roles WHERE rolname = 'supabase_admin') THEN
        EXECUTE format('CREATE ROLE supabase_admin WITH SUPERUSER CREATEDB CREATEROLE LOGIN PASSWORD %L', db_password);
    END IF;
    
    -- Rôle auth admin
    IF NOT EXISTS (SELECT FROM pg_roles WHERE rolname = 'supabase_auth_admin') THEN
        EXECUTE format('CREATE ROLE supabase_auth_admin WITH SUPERUSER CREATEDB CREATEROLE LOGIN PASSWORD %L', db_password);
    END IF;
    
    -- Rôle authenticator pour PostgREST
    IF NOT EXISTS (SELECT FROM pg_roles WHERE rolname = 'authenticator') THEN
        EXECUTE format('CREATE ROLE authenticator NOINHERIT LOGIN PASSWORD %L', db_password);
    END IF;
    
    -- Rôle anon (lecture publique)
    IF NOT EXISTS (SELECT FROM pg_roles WHERE rolname = 'anon') THEN
        CREATE ROLE anon NOINHERIT;
    END IF;
    
    -- Rôle authenticated (utilisateurs connectés)
    IF NOT EXISTS (SELECT FROM pg_roles WHERE rolname = 'authenticated') THEN
        CREATE ROLE authenticated NOINHERIT;
    END IF;
    
    -- Permissions
    GRANT anon TO authenticator;
    GRANT authenticated TO authenticator;
    
    -- Permissions sur le schéma public
    GRANT USAGE ON SCHEMA public TO anon, authenticated;
    GRANT ALL ON ALL TABLES IN SCHEMA public TO anon, authenticated;
    GRANT ALL ON ALL SEQUENCES IN SCHEMA public TO anon, authenticated;
    ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON TABLES TO anon, authenticated;
    ALTER DEFAULT PRIVILEGES IN SCHEMA public GRANT ALL ON SEQUENCES TO anon, authenticated;
END
$$;

