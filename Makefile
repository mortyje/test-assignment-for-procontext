init:
	docker compose run --rm composer create-project laravel/laravel:^11.0 .
	cp .env.example .env || true
	docker compose run --rm php-cli php artisan key:generate
	docker compose up -d --build
	docker compose exec php-cli php artisan migrate

up:
	docker compose up -d --build

down:
	docker compose down

bash:
	docker compose exec php-fpm bash

cli:
	docker compose exec php-cli bash

composer:
	docker compose run --rm composer install

artisan:
	docker compose exec php-cli php artisan

migrate:
	docker compose exec php-cli php artisan migrate

logs:
	docker compose logs -f