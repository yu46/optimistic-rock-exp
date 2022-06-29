## Setup {project_name}

### Setup Server

#### Setup .env for Docker

```bash
cp .env.example .env
cp config/.env.docker config/.env
```

Set the port number you want to map to the host side to `APP_HTTP_PORT` in the .env file.  
If you want to operate as non-root user, set the `GID` and `UID` on the host side.  
If this is not set, it will operate as root user.

```text
APP_HTTP_PORT=8812
UID=
GID=
```

#### Build and start containers

```bash
docker-compose up -d --build
```

### Install CakePHP

```bash
docker-compose exec php bash -c "composer install"
```

### Composition

**CakePHP**

http://localhost:{your_port}/

**phpmyadmin**

http://localhost:{your_port}/phpmyadmin/


