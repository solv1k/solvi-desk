install:
	cp .env.example .env && \
	composer install && \
	npm install --legacy-peer-deps && \
	npm run build && \
	php artisan key:generate && \
	./vendor/bin/sail build --no-cache
storage-link:
	./vendor/bin/sail artisan storage:link
migrate:
	./vendor/bin/sail artisan migrate
seed:
	./vendor/bin/sail artisan db:seed
up:
	./vendor/bin/sail up -d
down:
	./vendor/bin/sail down