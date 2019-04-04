include .env
export

php     = app
db      = db
nodejs  = nodejs
nginx  = webserver
current_date = $(date '+%Y-%m-%d')

container_php       = $(DOCKER_PREFIX)-$(php)
container_db        = $(DOCKER_PREFIX)-$(db)
container_nodejs    = $(DOCKER_PREFIX)-$(nodejs)

#####################################
###                               ###
### MakeFile for Laravel Skeleton ###
###                               ###
#####################################


echo:
	@echo $(php)

help: #prints list of commands
	@cat ./makefile | grep : | grep -v "grep"

composer_dep: #install composer dependency >> ./vendors
	@docker run --rm -v $(CURDIR):/app composer install

key: #generate APP key
	@sudo docker-compose exec $(php) php artisan key:generate

set_user_permit:
	@sudo chown -R $(USER):$(USER) $(CURDIR)


create_pub_simlink: #
	@docker-compose exec $(php) php artisan storage:link

#####################################
###                               ###
###       Start/stop project      ###
###                               ###
#####################################

start_local: set_perm_storset_perm_stor #start docker container for LOCAL ENV
	@sudo docker-compose -f docker-compose-local.yml up -d

#start: set_perm_storset_perm_stor #start docker container
#	@sudo docker-compose up -d

stop_local: #stop docker container
	@sudo docker-compose -f docker-compose-local.yml down

#stop: #stop docker container
#	@sudo docker-compose down


#####################################
###                               ###
###       Work in containers      ###
###                               ###
#####################################

show: #show docker's containers
	@sudo docker ps

connect_app: #Connect
	@docker-compose exec $(php) bash

connect_db: #Connect
	@docker-compose exec $(db) bash

connect_nodejs: #Connect
	@sudo docker-compose exec $(nodejs) /bin/sh

connect_nginx: #Connect
	@sudo docker-compose exec $(nginx) /bin/sh


run_com_app: #Run commands in PHP container c=[commands]
	@sudo docker-compose exec $(php) $(c)

run_com_node: #Run commands in PHP container c=[commands]
	@sudo docker-compose exec $(nodejs) $(c)


#####################################
###                               ###
###       Work with Laravel       ###
###                               ###
#####################################

create_model: #create model name=[modelName]
	@docker-compose exec $(php) php artisan make:model Models/$(name) -m && make set_user_permit

create_controller: #create controller name=[controllerName]
	@docker-compose exec $(php) php artisan make:controller $(name)Controller && make set_user_permit

create_middleware: #create middleware name=[middlewareName]
	@docker-compose exec $(php) php artisan make:middleware $(name) && make set_user_permit

create_request: #create FormRequest name=[controllerName]
	@docker-compose exec $(php) php artisan make:request $(name) && make set_user_permit

create_job: #create Job name=[job]
	@docker-compose exec $(php) php artisan make:job $(name) && make set_user_permit

create_mailer: #create mailer name=[controllerName]
	@docker-compose exec $(php) php artisan make:mail $(name) && make set_user_permit

create_test: #create test name=[testName]
	@docker-compose exec $(php) php artisan make:test $(name)Test && make set_user_permit

create_seeder: #create seeder name=[seederName]
	@docker-compose exec $(php) php artisan make:seeder $(name)TableSeeder && make set_user_permit

create_provider: #create provider name=[providerName]
	@docker-compose exec $(php) php artisan make:provider $(name)ServiceProvider && make set_user_permit

#####################################
###                               ###
###          Work with FE         ###
###                               ###
#####################################

watch: #Run watch
	@sudo docker-compose exec $(nodejs) npm run watch

test: #test
	@sudo docker exec -it $(container_php) bash -c 'vendor/bin/phpunit'

tinker: #Run tinker
	@sudo docker-compose exec $(php) php artisan tinker

route: #Show routes
	@sudo docker-compose exec $(php) php artisan route:list

refresh: #Refresh the database and run all database seeds
	@@sudo docker exec -it $(container_php) bash -c 'php artisan migrate:refresh --seed'


clear_cache: #clear laravel cache php artisan optimize --force php artisan config:cache php artisan route:cache
	@sudo docker exec -it $(container_php) bash -c 'php artisan cache:clear && php artisan view:clear && php artisan route:clear && php artisan config:clear'


composer_update: #update vendors
	@sudo docker exec -it $(container_php) bash -c 'php composer.phar update'

composer_dump: #update vendors
	@sudo docker exec -it $(container_php) bash -c 'php composer.phar dump-autoload'

clear_log:
	@sudo cat /dev/null > storage/logs/laravel.log; sudo cat /dev/null > storage/logs/queue-worker.log

set_perm_storset_perm_stor:
	@sudo chmod -R 777 storage/
