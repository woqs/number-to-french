install:
	php composer.phar install

launch-test:
	php vendor/phpunit/phpunit/phpunit test/

launch:
	php run.php

dk-install:
	docker container run --rm -v $$(pwd):/app/ composer:2.2.5 composer install

dk-update:
	docker container run --rm -v $$(pwd):/app/ composer:2.2.5 composer update

dk-launch:
	docker container run --rm -v $$(pwd):/app/ php:8.1.2-cli php /app/run.php

dk-launch-test:
	docker container run --rm -v $$(pwd):/app/ php:8.1.2-cli php /app/vendor/phpunit/phpunit/phpunit /app/test/

fun-launch:
	php runFun.php

dk-fun-launch:
	docker container run --rm -v $$(pwd):/app/ php:8.1.2-cli php /app/runFun.php
