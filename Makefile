init: composer-update up

up:
	docker-compose up -d
down:
	docker-compose down

composer-update:
	docker-compose run php composer update

yii3:
	docker-compose run php ./yii $(filter-out $@, $(MAKECMDGOALS))

test:
	docker-compose run php ./vendor/bin/codecept run
psalm:
	docker-compose run php ./vendor/bin/psalm
