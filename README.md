# FullstackSJ

## Développement FullStack : Web/Mobile/Docker

### Contexte du projet
La plupart des produits disponibles sur le marché répondent à une architecture dites full stack.
En effet un grand nombre d’acteurs privés fonden t leurs produits avec une site web, un
backoffice permettant de gérer une base de données, une API permettant de faire l’interface
entre la base de données et les clients (mobiles ou web), et des applications mobiles. Le but est
de se rapprocher de l’envir onnement technique des sociétés sur le marché.

### Objectif du projet
Développer un système en deux parties. Une partie web comprenant un backoffice et une base
de données. Une autre partie concernant un client mobile.

### Description fonctionnelle des besoins
Le sujet de cet application est libre. En revanche l’application mobile devra démontrer une réelle
utilité pour l’utilisateur et être synchronisé avec le service web. De plus le déploiement de l’API,
la base de donnée et le backoffice devront se faire grâce à docker.

### Contraintes techniques
- Langage de programmation backoffice libre
- Base de données MariaDB ou Postgres
- Toute la stack web déployée grâce à Docker
- Application mobile native iOS (Swift ou SwiftUI) et/ou Android (Kotlin)

### Résultats attendus
Lors de la présentation vous devrez déployer toute votre stack web grâce à docker et présenter
les fonctionnalités et les données pré insérées en DB dans le backoffice. Vous ferez ensuite
démonstration des fonctionnalités de l’application mobile et prouverez la bonne synchronisation
des différentes stacks.

### Download
<code>
$ wget -O - https://github.com/moonlight83340/FullstackSJ/archive/master.tar.gz | tar -xzf - && mv FullstackSJ-master FullstackSJ
</code>

### Deployement
<code>
$ docker-compose pull # Download the latest versions of the pre-built images
</code>
<br/>
<code>
$ docker-compose up -d # Running in detached mode
</code>
<br/>
<code>
$ docker-compose exec php bin/console doctrine:schema:update --force --dump-sql
</code>

### Docker logs
<code>
$ docker-compose logs -f # follow the logs
</code>

### Accès API
https://localhost pour accèder à l'accueil de l'API

https://localhost:8443/ pour accèder à l'API

https://localhost:444 pour accèder à l'Administration de l'API

### Seulement en cas de déploiement en Production

## Building and Pushing the Docker Images

### Build the Docker images
<code>
$ docker-compose -f docker-compose-prod/docker-compose.build.yml pull --ignore-pull-failures
</code>
<br/>
<code>
$ docker-compose -f docker-compose-prod/docker-compose.build.yml build --pull
</code>

### Push the built images to the container registry
<code>
$ docker-compose -f docker-compose-prod/docker-compose.build.yml push
</code>

## Pulling the Docker Images and Running the Services
These steps should be performed on the production server.
<br/>
Make sure the environment variables required are set.
<br/>
You could set the environment variables in the .env file at the top level of the distribution project (not to be confused with api/.env which is used by the Symfony application). 
<br/>
For example:
<code>
ADMIN_HOST=admin.example.com
ADMIN_IMAGE=registry.example.com/api-platform/admin
API_HOST=api.example.com
APP_SECRET=3c857494cfcc42c700dfb7a6
CLIENT_HOST=example.com,www.example.com
CLIENT_IMAGE=registry.example.com/api-platform/client
CORS_ALLOW_ORIGIN=^https://(?:\w+\.)?example\.com$
DATABASE_URL=postgres://api-platform:4e3bc2766fe81df300d56481@db/api
MERCURE_ALLOW_ANONYMOUS=0
MERCURE_CORS_ALLOWED_ORIGINS=https://example.com,https://admin.example.com
MERCURE_HOST=mercure.example.com
MERCURE_JWT_KEY=4121344212538417de3e2118
MERCURE_JWT_SECRET=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJtZXJjdXJlIjp7InN1YnNjcmliZSI6WyJmb28iLCJiYXIiXSwicHVibGlzaCI6WyJmb28iXX19.B0MuTRMPLrut4Nt3wxVvLtfWB_y189VEpWMlSmIQABQ
MERCURE_SUBSCRIBE_URL=https://mercure.example.com/hub
NGINX_IMAGE=registry.example.com/api-platform/nginx
PHP_IMAGE=registry.example.com/api-platform/php
POSTGRES_PASSWORD=4e3bc2766fe81df300d56481
REACT_APP_API_ENTRYPOINT=https://api.example.com
TRUSTED_HOSTS=^(?:localhost|api|api\.example\.com)$
VARNISH_IMAGE=registry.example.com/api-platform/varnish
</code>

<blockquote>
Important: Please make sure to change all the passwords, keys and secret values to your own.
</blockquote>
  
### Set up a redirect from e.g. www.example.com to example.com
<code>
$ mkdir -p docker-compose-prod/docker/nginx-proxy/vhost.d
</code>
<br/>
<code>
$ echo 'return 301 https://example.com$request_uri;' > docker-compose-prod/docker/nginx-proxy/vhost.d/www.example.com
</code>
<br/>
<blockquote>
Note: If you do not want such a redirect, or you want it to be the other way round, please adapt to suit your needs.
</blockquote>

### (optional) Set up the Let's Encrypt integration.
<blockquote>
Note: If you are using Cloudflare, you might consider using their free SSL/TLS encryption setup as a simpler alternative. But if you would prefer to have full control, read on.
</blockquote>
Make sure the environment variables required for the Let's Encrypt integration are set.

You could set the environment variables in the .env file at the top level of the distribution project (not to be confused with api/.env which is used by the Symfony application). 
<br/>
For example:
<code>
LETSENCRYPT_USER_MAIL=user@example.com
LEXICON_CLOUDFLARE_AUTH_TOKEN=9e06358f74cbce70602c22fc3279f0aee3077
LEXICON_CLOUDFLARE_AUTH_USERNAME=user@example.com
</code>
<blockquote>
Note: If you are not using Cloudflare DNS, please see the documentation on how to pass the correct environment variables to Lexicon.
</blockquote>
Configure the (sub)domains for which you want certificate(s) to be issued for in docker-compose-prod/docker/letsencrypt/domains.conf. For example, to request a wildcard certificate for *.example.com and example.com:

<code>
*.example.com example.com autorestart-containers=api-platform_nginx-proxy_1
</code>

<blockquote>
Note: Replace the api-platform prefix in api-platform_nginx-proxy_1 with your Docker Compose project name (it defaults to the project directory name).
</blockquote>

## Pull the Docker images.

### If you are not using the (optional) Let's Encrypt integration:
<code>
$ docker-compose -f docker-compose-prod/docker-compose.yml pull
</code>

### If you are using the (optional) Let's Encrypt integration:
<code>
$ docker-compose -f docker-compose-prod/docker-compose.yml -f docker-compose-prod/docker-compose.letsencrypt.yml pull
</code>

## Bring up the services.

### If you are not using the (optional) Let's Encrypt integration:
<code>
$ docker-compose -f docker-compose-prod/docker-compose.yml up -d
</code>

### If you are using the (optional) Let's Encrypt integration:
<code>
$ docker-compose -f docker-compose-prod/docker-compose.yml -f docker-compose-prod/docker-compose.letsencrypt.yml up -d
</code>

