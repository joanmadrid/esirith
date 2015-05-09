#!/bin/sh
sudo chmod 777 -R app/cache
sudo chmod 777 -R app/logs
php composer.phar install
php app/console cache:clear --no-warmup
php app/console cache:clear --env=prod --no-warmup
#echo "y" | php app/console doc:mig:mig
php app/console doc:sc:up --force
php app/console assetic:dump
php app/console assets:install web
sudo chmod 777 -R app/cache
sudo chmod 777 -R app/logs