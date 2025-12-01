-- Schema PostgreSQL pour Supabase
-- Converti depuis MySQL/MariaDB
-- Note: Les extensions et rôles Supabase sont déjà créés par l'image supabase/postgres

-- Table: category
CREATE TABLE IF NOT EXISTS category (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- Table: role
CREATE TABLE IF NOT EXISTS role (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Table: language
CREATE TABLE IF NOT EXISTS language (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    code VARCHAR(10) NOT NULL
);

-- Table: theme
CREATE TABLE IF NOT EXISTS theme (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

-- Table: user
CREATE TABLE IF NOT EXISTS "user" (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INTEGER NOT NULL REFERENCES role(id),
    account_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_connection TIMESTAMP,
    language_id INTEGER REFERENCES language(id)
);

-- Table: vehicle
CREATE TABLE IF NOT EXISTS vehicle (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price_per_week DECIMAL(10,2) NOT NULL,
    available BOOLEAN DEFAULT TRUE,
    featured INTEGER DEFAULT 0,
    category_id INTEGER REFERENCES category(id),
    theme_id INTEGER REFERENCES theme(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: tag
CREATE TABLE IF NOT EXISTS tag (
    id SERIAL PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- Table: vehicle_tags (table de liaison)
CREATE TABLE IF NOT EXISTS vehicle_tags (
    vehicle_id INTEGER NOT NULL REFERENCES vehicle(id) ON DELETE CASCADE,
    tag_id INTEGER NOT NULL REFERENCES tag(id) ON DELETE CASCADE,
    PRIMARY KEY (vehicle_id, tag_id)
);

-- Table: reviews
CREATE TABLE IF NOT EXISTS reviews (
    id SERIAL PRIMARY KEY,
    vehicle_id INTEGER NOT NULL REFERENCES vehicle(id) ON DELETE CASCADE,
    user_id INTEGER NOT NULL REFERENCES "user"(id) ON DELETE CASCADE,
    rating INTEGER NOT NULL CHECK (rating >= 1 AND rating <= 5),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insertion des données initiales

-- Roles
INSERT INTO role (id, name) VALUES
(1, 'admin'),
(2, 'user')
ON CONFLICT (id) DO NOTHING;

-- Categories
INSERT INTO category (id, name, description) VALUES
(1, '4x4', 'Véhicules robustes adaptés pour les terrains difficiles et les aventures hors route.'),
(2, 'Van aménagé', 'Vans équipés pour des voyages longue durée avec des aménagements pour dormir et cuisiner.'),
(3, 'SUV', 'Véhicules spacieux et confortables, idéals pour les familles ou les groupes.'),
(4, 'Compact', 'Véhicules compacts, parfaits pour les voyages en ville et facile à garer.'),
(5, 'Luxe', 'Véhicules de luxe offrant un confort et des équipements haut de gamme.')
ON CONFLICT (id) DO NOTHING;

-- Languages
INSERT INTO language (id, name, code) VALUES
(1, 'English', 'EN'),
(2, 'Français', 'FR'),
(3, 'Español', 'ES'),
(4, 'Deutsch', 'DE'),
(5, 'Italiano', 'IT')
ON CONFLICT (id) DO NOTHING;

-- Themes
INSERT INTO theme (id, name, description) VALUES
(1, 'Aventure', 'Véhicules parfaits pour partir à l''aventure dans des conditions extrêmes.'),
(2, 'Familial', 'Confort et sécurité pour toute la famille.'),
(3, 'Éco-responsable', 'Véhicules à faible émission et consommation réduite, respectueux de l''environnement.'),
(4, 'Économique', 'Options abordables avec une bonne efficacité énergétique.'),
(5, 'Performance', 'Véhicules avec des performances de conduite supérieures pour les amateurs de vitesse.')
ON CONFLICT (id) DO NOTHING;

-- Tags
INSERT INTO tag (id, name) VALUES
(1, 'Tout-terrain'),
(2, 'Équipement de camping inclus'),
(3, 'Hybride ou électrique'),
(4, 'Grande autonomie'),
(5, 'Navigation GPS'),
(6, 'Sièges chauffants'),
(7, 'Toit ouvrant'),
(8, 'Idéal pour les road trips'),
(9, 'Animaux autorisés'),
(10, 'Porte-bagages'),
(11, 'Capacité de remorquage élevée'),
(12, 'Transmission manuelle'),
(13, 'Faible consommation'),
(14, 'Assurance tous risques incluse'),
(15, 'Disponible pour location à long terme')
ON CONFLICT (id) DO NOTHING;

-- Users (avec mots de passe hashés - à changer après migration)
INSERT INTO "user" (id, username, email, password, role_id, account_created) VALUES
(1, 'admin', 'admin@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, CURRENT_TIMESTAMP),
(2, 'user1', 'user1@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2, CURRENT_TIMESTAMP)
ON CONFLICT (id) DO NOTHING;

-- Vehicle (véhicules)
INSERT INTO vehicle (id, name, description, price_per_week, available, featured, category_id, theme_id) VALUES
(1, 'Land Rover Defender', 'Travel with a legend. The Land Rover Defender is an icon of resilience and reliability. Its timeless design and proven durability make it a top choice for adventurers who demand performance in the most demanding conditions. Get ready to make your mark in the wilds.', 1200.00, TRUE, 0, 1, 1),
(2, 'Toyota Hilux', 'Experience the raw power and robustness of the Toyota Hilux. Designed for the most challenging landscapes, it combines strength with advanced technology to deliver an unparalleled driving experience. Ideal for conquering tough trails and long expeditions with ease.', 1100.00, TRUE, 0, 1, 1),
(3, 'Mercedes Viano', 'Experience the space and comfort of the Mercedes Viano. With ample room for your passengers and gear, the Viano delivers a smooth and luxurious ride for long journeys. Perfect for those who seek both sophistication and capability on their road adventures.', 1300.00, TRUE, 0, 5, 2),
(4, 'Land Rover Discovery 4', 'Embark on your adventure with the Land Rover Discovery 4. Renowned for its luxurious comfort and exceptional off-road capabilities, this vehicle promises an unforgettable journey through any terrain. Perfect for those who seek both sophistication and ruggedness on their travels.', 1250.00, TRUE, 0, 1, 1),
(5, 'VW Caravelle', 'Experience the power and robustness of the VW Caravelle. Designed for the most challenging landscapes, it combines strength with advanced technology to deliver an unparalleled driving experience. Ideal for conquering tough trails and long expeditions with ease.', 1000.00, TRUE, 0, 2, 2),
(6, 'Jeep Wrangler', 'Experience the iconic Jeep Wrangler, designed for freedom and engineered to deliver top performance on and off the road. Ideal for those who crave adventure and wish to explore without boundaries.', 1100.00, TRUE, 0, 1, 1),
(7, 'Nissan Patrol', 'Experience the raw power and robustness of the Nissan Patrol. Designed for the most challenging landscapes, it combines strength with advanced technology to deliver an unparalleled driving experience. Ideal for conquering tough trails and long expeditions with ease.', 1150.00, TRUE, 0, 1, 1),
(8, 'Dodge Ram', 'Discover the legendary power and capability of the Dodge Ram. Built for the toughest jobs and the most rugged terrain, it offers unparalleled performance and durability. Whether it''s hauling heavy loads or tackling off-road adventures, the Dodge Ram is ready to conquer any challenge with style.', 1300.00, TRUE, 0, 1, NULL)
ON CONFLICT (id) DO NOTHING;

-- Réinitialiser les séquences pour les prochains inserts
SELECT setval('category_id_seq', (SELECT MAX(id) FROM category));
SELECT setval('role_id_seq', (SELECT MAX(id) FROM role));
SELECT setval('language_id_seq', (SELECT MAX(id) FROM language));
SELECT setval('theme_id_seq', (SELECT MAX(id) FROM theme));
SELECT setval('tag_id_seq', (SELECT MAX(id) FROM tag));
SELECT setval('user_id_seq', (SELECT MAX(id) FROM "user"));
SELECT setval('vehicle_id_seq', (SELECT MAX(id) FROM vehicle));

-- Activer Row Level Security (RLS) pour Supabase
-- Par défaut, on autorise tout pour l'instant (à ajuster selon vos besoins)
ALTER TABLE category ENABLE ROW LEVEL SECURITY;
ALTER TABLE role ENABLE ROW LEVEL SECURITY;
ALTER TABLE language ENABLE ROW LEVEL SECURITY;
ALTER TABLE theme ENABLE ROW LEVEL SECURITY;
ALTER TABLE "user" ENABLE ROW LEVEL SECURITY;
ALTER TABLE vehicle ENABLE ROW LEVEL SECURITY;
ALTER TABLE tag ENABLE ROW LEVEL SECURITY;
ALTER TABLE vehicle_tags ENABLE ROW LEVEL SECURITY;
ALTER TABLE reviews ENABLE ROW LEVEL SECURITY;

-- Politiques RLS basiques (lecture publique, écriture avec service key)
-- À ajuster selon vos besoins de sécurité
CREATE POLICY "Public read access" ON category FOR SELECT USING (true);
CREATE POLICY "Public read access" ON role FOR SELECT USING (true);
CREATE POLICY "Public read access" ON language FOR SELECT USING (true);
CREATE POLICY "Public read access" ON theme FOR SELECT USING (true);
CREATE POLICY "Public read access" ON vehicle FOR SELECT USING (true);
CREATE POLICY "Public read access" ON tag FOR SELECT USING (true);
CREATE POLICY "Public read access" ON vehicle_tags FOR SELECT USING (true);
CREATE POLICY "Public read access" ON reviews FOR SELECT USING (true);

