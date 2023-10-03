default: run

run:docker_up composer_install copy_env create_keys migrate_fresh

docker_up:
	docker compose up -d

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

migrate_fresh:
	docker compose exec app sh -c 'php artisan migrate:fresh'
