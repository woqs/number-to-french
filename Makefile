install:
	php composer.phar install

launch-test:
	php vendor/phpunit/phpunit/phpunit test/

launch:
	php run.php

dk-launch:
	docker container run --rm -v $$(pwd):/app/ php:7.1.33-cli php /app/run.php

dk-launch-test:
	docker container run --rm -v $$(pwd):/app/ php:7.1.33-cli php /app/vendor/phpunit/phpunit/phpunit /app/test/
