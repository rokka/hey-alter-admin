<img src="https://heyalter.com/wp-content/uploads/2020/06/header-2048x1171.jpg">

## Getting started

- git clone https://github.com/rokka/hey-alter-admin.git
- cd hey-alter-admin/
- composer update
- cp .env.example .env
- ./vendor/bin/sail up
- php artisan key:generate
- php artisan migrate:install
- php artisan migrate
