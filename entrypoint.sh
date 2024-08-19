# Boucle pour exécuter la migration jusqu'à ce qu'elle se termine avec succès
while true; do
  php bin/console d:m:m --no-interaction && break
  # Attend quelques secondes entre les tentatives
  sleep 5s
done

php bin/console cache:clear
chown -R www-data:www-data /var/www/var
chown www-data:www-data /var/www/public/pictures
php bin/console asset-map:compile

# Une fois la migration réussie, démarrez php-fpm
php-fpm