# =========================
# INFRA
# =========================

up:
	docker compose up -d --build

down:
	docker compose down

logs:
	docker compose logs -f


# =========================
# BOOTSTRAP
# =========================

bootstrap:
	test ! -d app || rm -rf app
	docker compose run --rm composer create-project laravel/laravel:^11.0 app
	docker compose run --rm php-cli php artisan install:api --no-interaction


# =========================
# SETUP
# =========================

init-env:
	cp .env.example .env

setup:
	docker compose up -d --build
	docker compose run --rm php-cli php artisan key:generate
	docker compose run --rm php-cli php artisan migrate


# =========================
# LARAVEL SHORTCUTS
# =========================

migrate:
	docker compose exec php-cli php artisan migrate

migrate-fresh:
	docker compose exec php-cli php artisan migrate:fresh

artisan:
	docker compose exec php-cli php artisan

bash:
	docker compose exec php-cli bash


# =========================
# COMPOSER
# =========================

composer-install:
	docker compose run --rm composer install

composer-update:
	docker compose run --rm composer update