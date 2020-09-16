up: docker-up
down: docker-down
restart: docker-down docker-up
init: docker-down laravel-test-clear docker-pull docker-duild docker-up laravel-db-init composer-install assets-install seeds assets-dev horizon

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-duild:
	docker-compose build

tests:
	docker-compose run --rm laravel-php-cli vendor/bin/phpunit --colors=always

composer-install:
	docker-compose run --rm laravel-php-cli composer install

assets-install:
	docker-compose run --rm laravel-node-cli yarn install

assets-dev:
	docker-compose run --rm laravel-node-cli yarn dev

laravel-db-init: laravel-test-wait-db laravel-db-ready

laravel-test-clear:
	docker run --rm -v ${PWD}/laravel-test:/app --workdir=/app alpine rm -f .ready

laravel-test-wait-db:
	until docker-compose exec -T laravel-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done

laravel-db-ready:
	docker run --rm -v ${PWD}/laravel-test:/app --workdir=/app alpine touch .ready

seeds:
	docker-compose run --rm laravel-php-cli php artisan db:wipe
	docker-compose run --rm laravel-php-cli php artisan migrate
	docker-compose run --rm laravel-php-cli composer dump-autoload -o
	docker-compose run --rm laravel-php-cli php artisan db:seed

horizon:
	docker-compose run --rm laravel-php-cli php artisan horizon

swagger:
	docker-compose run --rm laravel-php-cli vendor/bin/openapi -o public/docs/swagger.json app/Http

git:
	git status
	git add .
	git commit -m "${M}"
	git push -u origin master

my:
	sudo chown -R ${USER}:${USER} laravel-test
	sudo chown -R ${USER}:www-data ./laravel-test/test/storage
	sudo chown -R ${USER}:www-data ./laravel-test/test/bootstrap/cache
	chmod -R 775 ./laravel-test/test/storage
	chmod -R 775 ./laravel-test/test/bootstrap/cache

