#!/bin/bash
cd /home/ubuntu/shreeshyamsevak

STAGE=$1  # yeh argument se lega jaise "prod" ya "dev"

APP_NAME=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/APP_NAME" --with-decryption --query "Parameter.Value" --output text)
APP_DEBUG=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/APP_DEBUG" --with-decryption --query "Parameter.Value" --output text)
APP_KEY=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/APP_KEY" --with-decryption --query "Parameter.Value" --output text)
APP_URL=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/APP_URL" --with-decryption --query "Parameter.Value" --output text)
DB_HOST=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/DB_HOST" --with-decryption --query "Parameter.Value" --output text)
DB_DATABASE=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/DB_DATABASE" --with-decryption --query "Parameter.Value" --output text)
DB_USERNAME=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/DB_USERNAME" --with-decryption --query "Parameter.Value" --output text)
DB_PASSWORD=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/DB_PASSWORD" --with-decryption --query "Parameter.Value" --output text)
FILESYSTEM_DRIVER=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/FILESYSTEM_DRIVER" --with-decryption --query "Parameter.Value" --output text)
MEDIA_DISK=$(aws ssm get-parameter --name "/shreeshyamsevak/$STAGE/FILESYSTEM_DRIVER" --with-decryption --query "Parameter.Value" --output text)

# Function to update or add env key
update_env() {
    KEY=$1
    VALUE=$2
    if grep -q "^$KEY=" .env; then
        sed -i "s|^$KEY=.*|$KEY=$VALUE|" .env
    else
        echo "$KEY=$VALUE" >> .env
    fi
}

update_env APP_NAME "$APP_NAME"
update_env APP_DEBUG "$APP_DEBUG"
update_env APP_KEY "$APP_KEY"
update_env APP_URL "$APP_URL"
update_env DB_HOST "$DB_HOST"
update_env DB_DATABASE "$DB_DATABASE"
update_env DB_USERNAME "$DB_USERNAME"
update_env DB_PASSWORD "$DB_PASSWORD"
update_env FILESYSTEM_DISK "$FILESYSTEM_DRIVER"
update_env MEDIA_DISK "$FILESYSTEM_DRIVER"

composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache

sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

sudo systemctl reload apache2