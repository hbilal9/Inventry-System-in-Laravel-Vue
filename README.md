## Setup

After cloning

-   composer update/install
-   npm install
-   cp .env.example .env and place database name etc
-   go to AppServiceProvider (use Illuminate\Support\Facades\Schema;
    and Schema::defaultStringLength(255); )
-   php artisan migrate:fresh --seed
-   php artisan passport:install --force
-   php artisan storage:link
-   php artisan key:generate
