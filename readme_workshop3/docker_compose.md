# Docker compose yaml file changes

## 1. New Services

### 1.1 Postgres Database Service

- Since we will use Postgres Database we will have to install it.
- This will be added as a new service in the docker-compose.yml file.
- We will be using `postgres:14.3` image.
- Add the below code to your docker-compose.yml file (Make sure your indentations are correct, you can refer how other services are added in that file)

```yaml

  service_postgresdb:
    image: postgres:14.3
    container_name: service_postgresdb
    environment:
      POSTGRES_ROOT_PASSWORD: root
      POSTGRES_USER: user
      POSTGRES_PASSWORD: password
      POSTGRES_DB: site_blog
    ports:
      - "5431:5432"
    volumes:
      - /home/postgres_blog_db:/var/lib/postgresql/data

```

### 1.2 PgAdmin Service

- We will use this service to access database easily, Its comfortable to use and understand as it provides UI.
- We will be using `dpage/pgadmin4` image.
- Add the below code in docker-compose.yaml file

```yaml

  service_pgadmin:
    image: dpage/pgadmin4
    environment:
      - PGADMIN_DEFAULT_EMAIL=admin@unicourt.com
      - PGADMIN_DEFAULT_PASSWORD=password
    ports:
      - "8000:80"
    links:
      - service_postgresdb:postgress

```

### 1.3 PHP Service

- In previous workshop we created a `php` service using the image `php:8-fpm` directly in the docker-compose.yaml file.
- Now to build our application just `php:8-fpm` image will not be enough
  - `php:8-fpm` image does not have ``pdo_pgsql` driver which is used to connect to postgres database.
  - We will have to install the `pdo_pgsql` driver inside the `php:8-fpm` image.
  - To overcome this issue we will build our custom image using `php:8-fpm` image as our base image and then install `pdo_pgsql` driver in it.
  - We will use a Dockerfile to install the required drivers or applications in our image.
- Delete the existing `php` image and lets create a new service.
- Add the below code in docker-compose.yaml file.

```yaml

  service_php:
    image: blog:latest
    build:
      context: ./
      dockerfile: docker/Dockerfile
    container_name: php
    env_file:
      - .env
    volumes:
      - ./src:/code

```
