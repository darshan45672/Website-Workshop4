# Dockerfile creation

- A docker file is used to build a custom image where we can run commands to install or copy or delete etc.
- Add the below code in simple-blog/docker/Dockerfile file.

```Dockerfile

FROM php:8-fpm

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

```

- In above code , Line 1 `FROM php:8-fpm` if the base image, Its the same image which we had used in workshop 2. 
- Instead of adding it directly in the service of docker-compose.yaml file we will use it in Dockerfile.
- `RUN apt-get update` This is a command which will run the `apt-get update` command.
- the last RUN command is to install all the drivers required to access postgres database.
