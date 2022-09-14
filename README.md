## Docker

- docker-compose build
- docker-compose up -d
- docker exec -it vq_php bash (enter the main container)

## App (run commands in vq_php container)
- composer install
- npm install
- php artisan optimize:clear
- php artisan migrate
- npm run dev

### Optional
- ./vendor/bin/pest


## DONE
Now you can access app on http://localhost:4000
