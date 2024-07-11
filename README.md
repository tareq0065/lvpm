## lvpm - Laravel-Vue Products Manager

### Run locally


`git clone https://github.com/tareq0065/lvpm.git .
`

`composer install
`

`npm install`

`php artisan migrate --seed`

`npm run dev`

`php artisan serve`

Then register a new user and use it.

## Run App With GNU Make (UNIX Based OS: MacOS, Linux)

- `make run-app-with-setup` : build docker and start all docker containers with Laravel setup
- `make run-app-with-setup-db` : build docker and start all docker containers with Laravel setup + database migration and seeder
- `make run-app` : start all docker container
- `make kill-app` : kill all docker container
- `make enter-nginx-container` : enter docker nginx container
- `make enter-php-container` : enter docker php container
- `make enter-mysql-container` : enter docker mysql container
- `make flush-db` : run php migrate fresh command
- `make flush-db-with-seeding` : run php migrate fresh command with seeding
- `make code-format-check` : run npm command to run prettier to check your code
- `make code-format`: run npm command to run prettier to format your code
- `make code-test`: run php artisan test command

### Note

I have used vue with tailwind css to make the UI.
