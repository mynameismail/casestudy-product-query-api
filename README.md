# Product Query API
API for search product and consume queue from Product Command API (https://github.com/mynameismail/casestudy-product-command-api)

## setup
- create database
- run `composer install`
- create file `.env` (look at `.env.example`)
- run `php artisan key:generate`
- run `php artisan migrate`

## serve
- run `php artisan serve`
- run `php artisan queue:consume add_category`
- run `php artisan queue:consume add_product`

## test
- (optional) create database
- (optional) create file `.env.testing`
- run `php artisan test`
