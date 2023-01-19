# Default Laravel structure

## Installation
First of all create .env file.

```
cp .env.example .env
```


Install Docker and run this command on the project directory.
```
docker compose up --build -d
```
Run this command to setup dependency
```
docker compose exec app composer install
```
## Create Database user
```
open postgress terminal in docker and type

psql -h localhost -U postgres
psql (13.4 (Debian 13.4-1.pgdg110+1))psql (13.7 (Debian 13.7-1.pgdg110+1))

CREATE USER postgress WITH PASSWORD 'rasmy'
```
## don't forget to enter to pgadmin
````
username:admin@pgaccounts.na
password:postgres
connect database to your pgadmin using host seamsLab-pgsql
create database called "seamslab"
migrate DB
````
Run this command to run migration
```
docker compose exec app php artisan migrate
```

## Generate swagger documentation 
````
1- open app cmd 
run
php artisan l5-swagger:generate
you can access swagger by this link
"http://localhost/docs#/Auth"
you can test all APIS from that link
````

Run this command to create migration
```
docker compose exec app php artisan make:migration <migration_name>
```

Run this command to revert last migration
```
docker compose exec app php artisan migrate:rollback
```

Run this command to regenerate swagger
```
docker compose exec app php artisan l5-swagger:generate
```

Run this command to generate resource including controller, resource, request and migration
```
docker compose exec app php artisan make:model <resource_name> --migration --controller --resource --requests
```

## Running
```
docker compose up --build -d
```

