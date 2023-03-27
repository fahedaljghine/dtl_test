## Run the project

- composer install
- .\vendor\bin\sail shell
- .\vendor\bin\sail cp .env.example .env
- .\vendor\bin\sail php artisan key:generate
- .\vendor\bin\sail php artisan migrate:fresh --seed
- .\vendor\bin\sail up


** you can find the post man collection and env to test apis
