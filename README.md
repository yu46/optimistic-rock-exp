# HelloCake

## Initial Setup

HelloCake is a CakePHP development environment based on Docker.

### Setup Server

#### Setup .env for Docker

```bash
cp .env.example .env
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
docker-compose exec php bash -c "./install.sh"
or
docker-compose exec php bash -c "./install.sh -i 3.*" //default 4.*
```

### Start Project

```bash
rm -r install.sh .git README.md && mv PROJECT_README.md README.md
git init
```

