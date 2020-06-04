# Crazy Meme

## Installation

### With Make

```bash
make start
make build
```

to stop project:

```bash
make kill
```

### Without Make

```bash
docker-compose up
docker-compose exec php composer install
docker-compose exec php bin/console doctrine:database:drop   --if-exists --force
docker-compose exec php bin/console doctrine:database:create --if-not-exists --no-interaction
docker-compose exec php bin/console doctrine:migrations:migrate --allow-no-migration --no-interaction
docker-compose exec php bin/console doctrine:fixtures:load -n
```

to stop project:

```bash
docker-compose kill
```
