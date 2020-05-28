## About Soapbox

Soapbox is single page application blog built using Laravel and Vue.

- [Live Site](https://soapbox.andrewbilenduke.com).
- [Creator: Andrew Bilenduke](https://andrewbilenduke.com).

## Setup

Follow the steps below to run the site locally.

- `git clone git@github.com:ABilenduke/soapbox.git`
- `cd soapbox`
- `cp .env.example .env`
- `code .env`
- add the mysql database name, user and password to the env file.
- add mail credentials such as mailtrap.io
- Change the `xdebug.remote_host` in the `./php/xdebug.ini` depending on your environment
- - Using windows or mac with docker desktop use `"host.docker.internal"` as the value
- - Using linux (if you are using wsl with docker desktop this applies as well) use the systems ip address. Use the command `ifconfig` if you are not sure what your ip is, get the inet value.
- `docker-compose up -d --build`
- `docker-compose exec php_fpm_app key:generate`
- `docker-compose exec php_fpm_app db:migrate`
