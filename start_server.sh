cd server
composer install
php artisan migrate --seed
php -S localhost:3000 -t ./public &
php artisan queue:work &
cd ..
node ./client/client.js
