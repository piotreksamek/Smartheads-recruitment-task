# Smartheads recruitment task
Projekt został stworzony zgodnie z zasadami Domain-Driven Design (DDD), co pozwala na lepszą strukturę i organizację kodu.

Informacje techniczne:
PHP: 8.2
Symfony: 7.2
Docker: 27.3.1

## Przygotowanie projektu
Aby uruchomić projekt, wykonaj poniższe kroki:
1. Skopiuj plik docker-compose.override.yml.dist, tworząc na jego podstawie docker-compose.override.yml.
2. W pliku docker-compose.override.yml ustaw swoje własne porty.
3. Wykonaj następujące polecenia:
```
docker network create smartheads-task
```

```
docker compose build
```

```
docker compose up -d
```

```
docker compose exec -it smartheads-app bash
composer install
php bin/console doctrine:migrations:migrate
```
Żeby zobaczyć rekordy z formularza. Potrzebujemy stworzyć usera poprzez komendę CLI, a następnie się zalogować w panelu:
```
docker compose exec -it smartheads-app bash
php bin/console app:create-user {poprawny adres email} {hasło >= 8 liter}
np:
php bin/console app:create-user piotreksamek07@gmail.com test1234
```

Wysłane maile znadjują się w kontenerze MailCatcher'a
defaultowy port: http://localhost:1080/
