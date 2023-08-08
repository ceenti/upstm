# Append -bullseye to use Debian 11 (bullseye) instead of Debian 10 (buster) if you are using arm64/v8 o Apple Silicon
FROM mcr.microsoft.com/devcontainers/php:0-8.1

# Install MariaDB client
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client \ 
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Install php-mysql driver
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install the Wordpress CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# Copy the apache configuration file for Wordpress React as the default site
COPY wordpress-react-template.conf /etc/apache2/sites-available/000-default.conf
