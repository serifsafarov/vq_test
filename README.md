## Docker

- docker-compose build
- docker-compose up -d
- docker exec -it vq_php bash (enter the main container)

## App (run commands in vq_php container)
- composer install
- npm install
- php artisan optimize:clear
- php artisan migrate

### Optional
- npm run dev
- ./vendor/bin/pest
