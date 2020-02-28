# Docuco Backend

## Instalación

Se necesita tener instalado **Docker** y **Docker Compose**.

- Copia la configuración ejemplo:
```
cp .env.example .env
```

- Cambia la configuración de base de datos:
```
DB_CONNECTION=pgsql
DB_HOST=docuco_db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=postgres
DB_PASSWORD=postgres_root_password
```

- Levanta las máquinas:
```
docker-compose up -d
```

- Composer:
```
docker-compose exec docuco_app composer install
```

- Solamente la primera vez, genera la key única de tu Laravel:
```
docker-compose exec docuco_app php artisan key:generate
```

- Creamos las tablas de la base de datos
```
docker-compose exec docuco_app php artisan migrate
```
*Si queremos cargar también datos predefinidos*:
```
docker-compose exec docuco_app php artisan db:seed
```

- Creamos las keys para la autenticación
```
docker-compose exec docuco_app php artisan passport:install
```

Ya puedes entrar en: http://localhost:8000/api


## Docker

Parar las máquinas:
```
docker-compose down
```

Entrar en la máquina:
```
docker-compose exec docuco_app bash
```

Ejecutar comandos dentro de las máquinas desde fuera:
```
docker-compose exec docuco_app ls
```

## Laravel - Artisan

Guarda la configuración en un fichero:
```
docker-compose exec docuco_app php artisan config:cache
```

Ejecuta las migraciones pendientes:
```
docker-compose exec docuco_app php artisan migrate
```

Instala la auteticación para la API:
```
docker-compose exec docuco_app php artisan passport:install
```

Abre la consola de Laravel:
```
docker-compose exec docuco_app php artisan tinker

>>> \DB::table('migrations')->get(); # Test para saber si esta bien configurada la conexión a la base de datos
```

## Testing

Tests de la API (Reales):
```
// Create a test in the Feature directory...
docker-compose exec docuco_app php artisan make:test UserTest
```

Tests Unitarios:
```
// Create a test in the Unit directory...
docker-compose exec docuco_app php artisan make:test UserTest --unit
```

Ejecutar todos los tests:
```
docker-compose exec docuco_app vendor/bin/phpunit
```

Ejecutar los test de API:
```
docker-compose exec docuco_app vendor/bin/phpunit --testsuite e2e
```

Ejecutar los tests unitarios:
```
docker-compose exec docuco_app vendor/bin/phpunit --testsuite unit
```

Ejecutar el detector de coding standard y todos los tests (E2E y Unitarios):
```
docker-compose exec docuco_app composer tests
```

#### Cobertura de test

Para ver la cobertura de test es necesario instalar xdebug https://github.com/derickr/xdebug
(ya esta instalado dentro de docker)

```
docker-compose exec docuco_app composer test-coverage-unit

o

docker-compose exec docuco_app vendor/phpunit/phpunit/phpunit --coverage-html html-coverage-unit --testsuite unit
```
Generará una carpeta html-coverage-unit con la cobertura de test visible en html

```
docker-compose exec docuco_app composer test-coverage-e2e

o

docker-compose exec docuco_app vendor/phpunit/phpunit/phpunit --coverage-html html-coverage-unit --testsuite e2e
```
Generará una carpeta html-coverage-e2e con la cobertura de test visible en html


## Comandos composer

Ejecuta la autocarga de clases (se utiliza cuando añadimos un nuevo seed)
```
docker-compose exec docuco_app composer dump-autoload
```

Ejecutar detector de calidad de código (test, linter, copy-paste):
```
docker-compose exec docuco_app composer quality-code-detector
```

Ejecutar coverage unitarios:
```
docker-compose exec docuco_app composer test-coverage-unit
```

Ejecutar coverage e2e:
```
docker-compose exec docuco_app composer test-coverage-e2e
```

Ejecutar detector de código duplicado:
```
docker-compose exec docuco_app composer copy-paste-detector
```

Arregla automaticamente coding standard fáciles:
```
docker-compose exec docuco_app vendor/bin/phpcbf
```
