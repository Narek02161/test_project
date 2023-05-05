# пересобирает контейнеры подготавливает базу для dev разработки
init: rebuild composer-install fresh-migrate db-seed passport-install passport-passport-keys
# пересобирает контейнеры подготавливает базу и запускает все тесты
test: down rebuild tests-prepare run-tests

# собирает контейнеры
up:
	docker-compose -f docker-compose.yml up -d
# Останавливает контейнеры и удаляет контейнеры, сети, тома и образы, созданные через up
down:
	docker-compose -f docker-compose.yml down --remove-orphans
# пересобрать контейнеры
rebuild:
	docker-compose -f docker-compose.yml up -d --build

# команды для инициализации dev среды
composer-install:
	docker exec -t  server-php composer install
fresh-migrate:
	docker exec -t  server-php php artisan migrate:fresh
db-seed:
	docker exec -t  server-php  php artisan db:seed
passport-install:
	docker exec -t  server-php  php artisan passport:install
passport-passport-keys:
	docker exec -t  server-php  php artisan passport:keys --force

tests-prepare: composer-install  tests-fresh tests-migrate seed-test passport-install-test

# команды для тестов
tests-fresh:
	docker exec -t server-php php artisan migrate:fresh --env=testing
tests-migrate:
	docker exec -t server-php php artisan migrate --env=testing
seed-test:
	docker exec -t server-php php artisan db:seed --class=TestDatabaseSeeder --env=testing
passport-install-test:
	docker exec -t server-php php artisan passport:install --env=testing
run-tests:
	docker exec -t server-php php artisan test

