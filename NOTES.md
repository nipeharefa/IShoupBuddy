Group Errr Bootstrap Cache

sudo chgrp -R www-data storage bootstrap/cache
sudo chmod -R ug+rwx storage bootstrap/cache

chmod -R 644 /etc/cron.d

service cron restart
