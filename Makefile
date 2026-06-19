# =========================
# INFRA
# =========================

up:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f

restart:
	docker compose down && docker compose up -d --build


# =========================
# BOOTSTRAP
# =========================

bootstrap:
	docker compose run --rm composer create-project laravel/laravel app "11.*"
	docker compose run --rm php-cli php artisan install:api --no-interaction

# =========================
# SETUP
# =========================

init-env:
	cp .env.example .env
	cp app/.env.example app/.env

setup:
	docker compose up -d --build
	docker compose run --rm php-cli php artisan key:generate
	docker compose run --rm php-cli php artisan migrate


# =========================
# DATABASE
# =========================

migrate:
	docker compose run --rm php-cli php artisan migrate

migrate-fresh:
	docker compose run --rm php-cli php artisan migrate:fresh --seed

seed:
	docker compose run --rm php-cli php artisan db:seed


# =========================
# ARTISAN
# =========================

artisan:
	docker compose run --rm php-cli php artisan

bash:
	docker compose run --rm php-cli bash

tinker:
	docker compose run --rm php-cli php artisan tinker


# =========================
# COMPOSER
# =========================

composer-install:
	docker compose run --rm composer install --no-interaction --prefer-dist

composer-update:
	docker compose run --rm composer update --no-interaction

composer-dump:
	docker compose run --rm composer dump-autoload


# =========================
# CACHE
# =========================

cache-clear:
	docker compose run --rm php-cli php artisan optimize:clear

cache-optimize:
	docker compose run --rm php-cli php artisan optimize