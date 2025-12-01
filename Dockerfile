FROM php:8.2-apache

# Activer le module rewrite d'Apache
RUN a2enmod rewrite

# Installer les dépendances pour PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev && rm -rf /var/lib/apt/lists/*

# Installer les extensions PHP nécessaires pour MySQL et PostgreSQL
RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql

# Configurer Apache pour utiliser /var/www/html comme document root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copier les fichiers du projet dans le conteneur
COPY . /var/www/html/

# Définir les permissions
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80

