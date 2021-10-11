<div align='right'>
    <a href="./README.md">Inglês |</a>
    <a href="./PORTUGUESE.md">Português</a>
</div>

<div align='center'>
    <h1>Money Transaction</h1>
    <a href="https://www.linkedin.com/in/leonardo-akio/" target="_blank"><img src="https://img.shields.io/badge/LinkedIn%20-blue?style=flat&logo=linkedin&labelColor=blue" target="_blank"></a> 
    <img src="https://img.shields.io/badge/version-v0.1-blue"/>
    <img src="https://img.shields.io/github/contributors/akioleo/MoneyTransaction_v2"/>
    <img src="https://img.shields.io/github/stars/akioleo/MoneyTransaction_v2?style=sociale"/>
    <img src="https://img.shields.io/github/forks/akioleo/MoneyTransaction_v2?style=social"/>
    <img src="https://img.shields.io/badge/License-MIT-blue"/>
</div>

<p align="center">
  <img src="https://i.postimg.cc/1Xk4pHSk/postman.png" alt="Sublime's custom image"/>
</p>


The project simulates a system of financial transactions to make transfers, deposits and withdrawals. The rules are, shopkeepers cannot transfer, only users; transfers cannot be of the same id and before any transfer or withdrawal is done, has one validation of the user's balance. The project was built in `PHP 8.0` and `Laravel 8.63`

## Table of Contents
- [Structure](#structure)
- [Getting Started](#getting-started)
	- [Installation](#installation)
	- [Configuration](#configuration)
	- [Versions](#versions)
- [Development](#development)
    - [Database relationships](#database-relationships)
        - [User-Store](#user-store) 
        - [Store-Products](#store-products)
        - [Products-Categories](#products-categories)
	- [Paths](#paths)
- [Contributing](#contributing)
- [License](#license)

## Structure 

```bash
├── app/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage./
├── tests/
├── vendor/
├── artisan
├── composer.json
├── composer.lock
├── package.json
├── phpunit.xml
├── server.php
├── webpack.mix.js
├── yarn.lock
```

## Getting Started
Open and view the Project using the `.zip` file provided
<br/>
Or to get started, clone the repository to your directory
```bash
> git clone https://github.com/akioleo/MoneyTransaction_v2.git
```    
Start the local development server
```bash
> php artisan serve
```   

### Installation
Install all the dependencies using composer
```bash
> composer install
```
Install front dependencies
```bash
> npm install
```
Create a new *.env* archive based on *.env.example*
```bash
> php -r "copy('.env.example', '.env');"
```
Generate a new artisan key
```bash
> php artisan key:generate
```
Generate a JWT Secret
```bash
> php artisan jwt:secret
```

### Configuration

In new `.env` file type your database credentials in these lines<br/>
*Obs: **DB_CONNECTION** changes by the database used. Example: Postgre database (**pgsql**), sqlite, sqlsrv*

    DB_CONNECTION=mysql  
    DB_HOST=127.0.0.1  
    DB_PORT=3306  
    DB_DATABASE=laravel  
    DB_USERNAME=root  
    DB_PASSWORD=
 
Run the database migrations to create predefined database tables with flag `--seed` to get initial data 
```bash
> php artisan migrate --seed
```   
Or run seeds later to populate the database with data
```bash
> php artisan db:seed  
```    
### Versions
We can check tools versions to avoid some errors 

    php --version  |  composer --version  |  php artisan laravel --version
    
Two Laravel Packages were used:

    tymondesigns/jwt-auth -> https://github.com/tymondesigns/jwt-auth
    spatie/laravel-fractal -> https://github.com/spatie/laravel-fractal
    
***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command
```bash
> php artisan migrate:fresh --seed
```

## Development

### Database relationships

#### User-Transaction
**1:N relationship** - where one user ***hasMany*** transactions and one transaction ***belongsTo*** an user
```php
- User
$this->hasMany(Transaction::class, 'payer_id', 'id');
- Payer
$this->belongsTo(User::class, 'payer_id', 'id');
* Payee *
$this->belongsTo(User::class, 'payee_id', 'id');
```


### Paths

- `app` - Contains all the Eloquent models
- `app/Api` - Contains the exception response structure
- `app/Http/Controllers/Admin` - Contains all admin user controllers
- `app/Http/Controllers/Api` - Contains all api controllers
- `app/Http/Controllers/Front` - Contains all front-end controllers
- `app/Http/Requests/Api` - Contains all admin user and api form requests
- `app/Services` - Contains all services to managing class dependencies and performing dependency injection
- `app/Traits` - Contains all traits of the project
- `app/Transformers` - Contains transformers to tranform data from model object
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder's
- `public/` - Contains public assets of project (css, and js) 
- `resources/views` - Contains blade documents (front-end)
- `routes` - Contains all the api routes defined in api.php file and web routes (web.php)
- `storage/app` - A directory to save private photos 
- `tests` - Contains all the application tests
- `tests/Feature` - Contains integration tests
- `tests/Feature` - Contains unit tests
- `vendor`- Includes the Composer dependencies in the file autoload.
- `.env` - A simple text configuration file for controlling your Applications environment constants.
- `composer.json` - Contains a project name, version and a few other details
- `composer.lock` - Records the exact versions that are installed
- `package.json` - Contains few packages such as vue and axios to help you get started building your JavaScript application
- `phpunit.xml`- A testing utility included by default in a fresh installation of Laravel

## Contributing

We'd love to have your helping hand on `MoneyTransaction`. If you have any contribuition, we can rate some pull requests.


## License

`Marketplace` is open source software [licensed as MIT][license].

[license]: https://github.com/git/git-scm.com/blob/main/MIT-LICENSE.txt
