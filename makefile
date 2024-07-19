build:
	symfony composer install
	symfony console --no-interaction doctrine:mi:mi
	symfony console --no-interaction do:fixture:load

install:
	make build