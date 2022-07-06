## Setup
- create main and test databases 
- run `composer install`
- copy `.env.example` to `.env`
- fill in the `DB_*` and `TEST_DB_*` variables in `.env`
- run `php artisan key:generate`
- run `php artisan migrate`
- run `npm install`

## Seeding test data
- run `php artisan db:seed --class=ChannelSeeder`

## Scheduled tasks
- Cronjob setup: https://laravel.com/docs/9.x/scheduling#running-the-scheduler
- If you want to sync manually run `php artisan sync`

## Usage
- go to `{BASE_URL}/videos/all`

## Tests
- run `php artisan test`
