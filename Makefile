default: run

run:docker_up composer_install copy_env create_keys migrate test

docker_up:
	docker compose up -d --build

composer_install:
	docker compose exec app sh -c 'composer install'

copy_env:
ifneq ($(wildcard .env),)
	echo '.env exists'
else
	echo 'Copying .env.example to .env' && cp .env.example .env
endif

create_keys:
	docker compose exec app sh -c 'php artisan key:generate'

migrate:
	docker compose exec app sh -c '(php artisan migrate:install -q -n || true) && php artisan migrate'

test:
	docker compose exec app sh -c '(touch database/test_db.sqlite || true) && composer test'
