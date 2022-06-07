# AT Detector Platform

## Requirements

Install docker : https://docs.docker.com/get-docker

## 1. Getting started
After install **Docker** successfully ! Run this command to set up environment.

```cmd
cp .env.example .env
```
then edit your .env based on your project installation documents.

### Init docker images and container (Once time running)
- Go to root project and run this command to build a new container:
    ```cmd
    docker-compose build
    ```

- After build is done, then run this command to run all services in the backround
    ```cmd
    docker-compose up -d
    ```

- To check all services is running, run this command
    ```cmd
    docker-compose ps
    ```

    Results (all 3 services are `UP`): 

        Name                      Command               State               Ports             
        ----------------------------------------------------------------------------------------------
        at-detector-platform   docker-php-entrypoint apac ...   Up      0.0.0.0:8099->80/tcp, 8099/tcp
        at-mongodb             docker-entrypoint.sh mongod      Up      0.0.0.0:27017->27017/tcp      
        mexpress               tini -- /docker-entrypoint ...   Up      0.0.0.0:8081->8081/tcp  


- Install Composer for Laravel, run this command
    ```cmd
    docker-compose exec app composer install
    ```

- Install Composer for Laravel, run this command
    ```cmd
    docker-compose exec app php artisan key:generate
    ```

Open `at-website` with browser at [http://localhost:8099](http://localhost:8099).


- To shut down all services from running and rebuild container, run this command
    ```cmd
    docker-compose down
    ```

## 2. Import database
Using sh file on [LINUX, MACOS]
```cmd
sh database.sh
```
Or using command line

```cmd
cd docker-compose/mongo
mongorestore -d <your-db-name-config-on-env-file> ./database/at-mongodb
```

Open `mongo-express web` with browser at [http://localhost:8081](http://localhost:8081) to manage database.

## 3. Dummy article 
Open this [http://localhost:8099/dummy/articles](http://localhost:8099/dummy/articles) to create dummy article data (if needed)

## 4. Technology
- PHP 8.1
- Laravel 8.83.15
- Mongodb
- Mongo Express

