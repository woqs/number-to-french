install:
	php composer.phar install

launch-test:
	php vendor/phpunit/phpunit/phpunit test/

launch:
	php run.php
