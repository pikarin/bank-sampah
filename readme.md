# Aplikasi Bank Sampah

## Dibuat dengan

+ [Laravel 5.7](https://laravel.com/docs/5.7)
+ [AdminLTE 3 alpha 2](https://adminlte.io)
+ [Bootstrap 4](https://getbootstrap.com/docs/4.1/getting-started/introduction)
+ [Font Awesome 5](https://fontawesome.com/start)

## Requirements

+ [Laravel Requirements](https://laravel.com/docs/5.7#server-requirements)
+ MySql >= 5.7 or MariaDB >= 10.2
+ Nodejs

## Instalasi

1. clone repository
2. install dependensi composer

        composer install

3. copy file environment

        cp .env.example .env

4. generate kunci aplikasi

        php artisan key:generate

5. update detail database pada file .env

        DB_CONNECTION=driver database
        DB_HOST=host database
        DB_PORT=port database
        DB_DATABASE=nama database
        DB_USERNAME=username database
        DB_PASSWORD=password database

6. migrate table
        
        php artisan migrate


## Testing

1. run phpunit pada terminal

        ./vendor/bin/phpunit
