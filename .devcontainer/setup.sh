#!/bin/bash

# Site configuration options
SITE_TITLE="Wordpress React Starter"
ADMIN_USER=admin
ADMIN_PASS=password
ADMIN_EMAIL="admin@localhost.com"

# Set to true to wipe out and reset the database
WP_RESET=true
WP_SEED=true

# Adding extra options to xdebug ini file
echo 'xdebug.discover_client_host=1' >> /usr/local/etc/php/conf.d/xdebug.ini

# Increase file upload max size in php.ini
sudo sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 12M/' /usr/local/etc/php/php.ini-development
sudo sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 12M/' /usr/local/etc/php/php.ini-production


echo "\nSetting up WordPress 🕸️\n"

DEVDIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

if $WP_RESET ; then
    echo "Resetting WP"
    wp plugin delete --all
    wp db reset --yes
fi

# Seed initial data

if $WP_SEED ; then
    echo "Seeding WP"
    wp db import $DEVDIR/starter_data/sql/seed.sql
    # Copy starter images
    echo 'Copying starter images'
    UPLOAD_DIR=web/app/uploads/2023/03/
    mkdir -p $UPLOAD_DIR
    cp -r $DEVDIR/starter_data/images/* $UPLOAD_DIR
fi


wp core install --url="http://localhost:8080" --title="$SITE_TITLE" --admin_user="$ADMIN_USER" --admin_email="$ADMIN_EMAIL" --admin_password="$ADMIN_PASS" --skip-email;
wp option update permalink_structure '/%postname%/'
wp rewrite flush

# Fix permissions to upload folder
sudo chgrp -R www-data web/app/uploads/
sudo chmod g+ws web/app/uploads/


echo "\nConfiguring Apache 🏹\n"

# Configuring apache to serve wordpress as the default site

sudo chmod a+x $(pwd) && sudo rm -rf /var/www/html && sudo ln -s $(pwd)/web /var/www/html
sudo a2enmod rewrite
sudo apache2ctl start


echo "Installing Composer dependencies for Bedrock"

composer install

echo "Installing Composer dependencies for Ress"

cd web/app/themes/wpreact

composer install
npm install --quiet --no-progress && npm run build

echo "Setting the default theme"

cd $DEVDIR
wp theme activate wpreact

