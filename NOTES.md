Group Errr Bootstrap Cache

sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

chmod -R 644 /etc/cron.d

* * * * * php /var/www/Skripsi/artisan schedule:run >> /dev/null 2>&1

service cron restart

### Change LatLng
ALTER TABLE `users` CHANGE `latitude` `latitude` DOUBLE(10,4) NULL DEFAULT NULL
