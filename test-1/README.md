# Dev test algo

## Installation des images Docker

	docker pull composer
	docker pull php:8.1-alpine

## Installation des dépendances

	docker run --rm --interactive --tty --user "$(id -u):$(id -g)" --volume $PWD:/app composer install

## Exécution
	
	docker run -it --rm --name eldo-test-algo -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:8.1-alpine php src/index.php
