check:
	vendor/bin/phpstan analyze
	vendor/bin/phpunit
	vendor/bin/phpcs src/
