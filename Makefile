install:
	docker-compose run composer composer install

phpstan:
	docker-compose run php ./vendor/bin/phpstan analyse -c config.neon

unit-test:
	docker-compose run php ./vendor/phpunit/phpunit/phpunit --display-notices --stderr --do-not-cache-result --bootstrap=./test/boostrap.php --test-suffix=test.php  ./test/unit/LinkedListTest.test.php
