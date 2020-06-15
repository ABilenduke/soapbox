## About Soapbox

Soapbox is single page application blog built using Laravel, Vue and Vuetify.

#### Site links
- [Live Site](https://soapbox.andrewbilenduke.com)
- [Creator: Andrew Bilenduke](https://andrewbilenduke.com)

#### Resource links
- [Laravel](https://laravel.com)
- [Vue](https://vuejs.org)
- [Vuetify](https://vuetifyjs.com)

## Setup

### Requirments
- Git
- Docker

Follow the steps below to run the site locally.

#### Copy the repository and change to new directory
- `git clone git@github.com:ABilenduke/soapbox.git`
- `cd soapbox`

#### Copy the example .env file and edit the file to add the correct values
- `cp .env.example .env`
- `code .env`
- Create a database name, user and password in the env file, these values will be used to create the mysql container. Make sure the `DB_HOST` environment variable is set to the mysql container name `mysql_db`.
- Set the `REDIS_HOST` environment variable to redis container name `redis`
- Add smtp mail credentials such as mailtrap.io (Mailhog to come soon)

#### Set the environment variables and create the docker containers
- Change the `xdebug.remote_host` in the `./php/xdebug.ini` depending on your environment
- - Using windows or mac with docker desktop use `"host.docker.internal"` as the value
- - Using linux use the systems ip address. Use the command `ifconfig` if you are not sure what your ip is, get the inet value.
- `docker-compose up -d --build`
- `docker-compose exec php_fpm_app composer install` (in production always add the flag `--no-dev`)

#### Setup the appliction
- `docker-compose exec php_fpm_app php artisan key:generate`
- `docker-compose exec php_fpm_app php artisan jwt:secret`
- `docker-compose exec php_fpm_app php artisan migrate`
- `docker-compose exec php_fpm_app php artisan db:seed`
- `docker-compose exec php_fpm_app php artisan storage:link`

#### Add categories using the custom command
- `docker-compose exec php_fpm_app php artisan soapbox:addCategories`

#### Running tests
- All: `docker-compose exec php_fpm_app php vendor/bin/phpunit`
- Individual: `docker-compose exec php_fpm_app php vendor/bin/phpunit --filter test_name`