chmod 0644 public/index.php
rm -r ../www/demos/feed
cp -r public ../www/demos/feed
php artisan optimize
