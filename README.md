# Docuco

## Requirments

You need to install:
* [Docker](https://www.docker.com/get-started)
* [Docker Compose](https://docs.docker.com/)

## To start

Copy `.env.example` to `.env` and change varaibles:
``` shell
cp .env.example .env
```

Build docker images with projects
```shell
docker-compose build
```

Run docker containers
```shell
docker-compose up -d
```

<!-- Install api dependencies
```shell
docker-compose exec docuco_api composer install
```

Install front dependencies
```shell
docker-compose exec docuco_front npm i
``` -->

Generate laravel key
```
docker-compose exec docuco_api php artisan key:generate
```

Create tables from database
```
docker-compose exec docuco_api php artisan migrate
```

If you want can add fake data in database
```
docker-compose exec docuco_api php artisan db:seed
```
> see users and passwords on file `api/database/seeds/UsersTableSeeder.php`

> be sure that are documents on folder `api/public/assets/documents`

Create keys for authentication login
```
docker-compose exec docuco_api php artisan passport:install
```

> Url to API: [http://localhost:8000/api](http://localhost:8000/api)

> Url to Front: [http://localhost:4200](http://localhost:4200)

## Docker on project

Project use docker compose to separate the diferents services, this are some commands:

containers names:
* API: `docuco_api`
* Front: `docuco_front`

Build iamge and containers:
```shell
docker-compose build
```

Start containers:
```shell
docker-compose up -d
```

Stop and dertoy containers:
```shell
docker-compose down
```

Go inside container:
```shell
docker-compose exec {container_name} bash
```

Run commands inside container:
```
docker-compose exec {container_name} {command}
```

## API

### Artisan commands for API

Run last migrations:
```
docker-compose exec docuco_app php artisan migrate
```

Refresh database:
```
docker-compose exec docuco_app php artisan migrate:refresh
```

Add seeds on database:
```
docker-compose exec docuco_app php artisan db:seed
```

Install keys for authentication:
```
docker-compose exec docuco_app php artisan passport:install
```

### Composer commands for API

Run autoload classes (run when add new seed)
```
docker-compose exec docuco_app composer dump-autoload
```

Run test:
```shell
docker-compose exec docuco_app composer test
docker-compose exec docuco_app composer test:unit
docker-compose exec docuco_app composer test:e2e
```

Run test coverage:
```shell
docker-compose exec docuco_app composer coverage
docker-compose exec docuco_app composer coverage:unit
docker-compose exec docuco_app composer coverage:e2e
```
> This generate `html-coverage-unit` or `html-coverage-e2e` with visible test coverage on html

See coding standard errors:
```shell
docker-compose exec docuco_app composer code:standard
```

Run fix coding standard:
```shell
docker-compose exec docuco_app composer code:fix
```

See duplicate code
```shell
docker-compose exec docuco_app composer code:duplicate
```

See quality code
```shell
docker-compose exec docuco_app composer code:quality
```

## FRONT

### Run test
> Be sure that are data on database.

To run test you need to install:

* npm
* node

or
* nvm

Go to `front` folder
```shell
cd front
```

Run cypress test
```shell
npm run e2e
```