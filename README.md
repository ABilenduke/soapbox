## About Soapbox

Soapbox is single page application blog built using Laravel, Vue and Vuetify.

- [Live Site](https://soapbox.andrewbilenduke.com)
- [Creator: Andrew Bilenduke](https://andrewbilenduke.com)


- [Laravel](https://laravel.com)
- [Vue](https://vuejs.org)
- [Vuetify](https://vuetifyjs.com)

## Setup

Follow the steps below to run the site locally.

- `git clone git@github.com:ABilenduke/soapbox.git`
- `cd soapbox`
- `cp .env.example .env`
- `code .env`
- Create a database name, user and password in the env file, these values will be used to create the mysql container. Make sure the `DB_HOST` environment variable is set to the mysql container name `mysql_db`.
- Set the `REDIS_HOST` environment variable to redis container name `redis`
- Add smtp mail credentials such as mailtrap.io (Mailhog to come soon)
- Change the `xdebug.remote_host` in the `./php/xdebug.ini` depending on your environment
- - Using windows or mac with docker desktop use `"host.docker.internal"` as the value
- - Using linux (if you are using wsl with docker desktop this applies as well) use the systems ip address. Use the command `ifconfig` if you are not sure what your ip is, get the inet value. (WSL 2 seems to change the ip, if xdebug doesn't work, make sure it hasn't changed)
- `docker-compose up -d --build`
- `docker-compose exec php_fpm_app composer install` (in production always add the flag `--no-dev`)
- `docker-compose exec php_fpm_app php artisan key:generate`
- `docker-compose exec php_fpm_app php artisan jwt:secret`
- `docker-compose exec php_fpm_app php artisan migrate`
- `docker-compose exec php_fpm_app php artisan db:seed`
- `docker-compose exec php_fpm_app php artisan storage:link`

Running tests
- `docker-compose exec php_fpm_app php vendor/bin/phpunit`