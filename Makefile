all:

.PHONY: lint test

lint:
	./vendor/bin/phpcs --standard=PSR2 src/

lint-fix:
	./vendor/bin/phpcbf --standard=PSR2 src/

check: lint
	./vendor/bin/phpunit --bootstrap vendor/autoload.php src/tests
