all: build

.PHONY: build push run dev-build deploy


lint:
	./vendor/bin/phpcs synq

test:
	./vendor/bin/phpunit --bootstrap vendor/autoload.php src/tests
