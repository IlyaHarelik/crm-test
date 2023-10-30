copy .env

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password

alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'

sail up

sail composer install

sail npm install

sail npm run dev

sail artisan migrate --seed

sail artisan storage:link 
