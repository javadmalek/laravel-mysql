# INDUSTRIAL RFQ
>

INDUSTRIAL RFQ is a marketing tool for industrial companies to publish their requests and receiving a couple of offers from suppliers.


## Installing / Getting started

A quick introduction of the minimal setup you need to get a hello world up &
running.

```shell
commands here
```
Here you should say what actually happens when you execute the code above.

## Developing

### Built With
List main libraries, frameworks used including versions (React, Angular etc...)

### Prerequisites
What is needed to set up the dev environment. For instance, global dependencies or any other tools. include download links.


### Setting up Dev

Here's a brief intro about what a developer must do in order to start developing
the project further:

```shell
git clone https://gitlab.industrial-cloud.com:10443/mrjavad/industrial-rfq-v1.git
cd industrial-rfq-v1
composer install
```

And state what happens step-by-step. If there is any virtual environment, local server or database feeder needed, explain here.

### Building

If your project needs some additional steps for the developer to build the
project after some code changes, state them here. for example:

```shell
php artisan key:generate
Create a database and inform .env
php artisan migrate --seed      to create and populate tables
php artisan serve               to start the app on http://localhost:8000/
```

The Eloquent ORM included is used to make a synchronization between models and tables. 
All the possible commands are available [Here](https://laravel.com/docs/5.0/eloquent)  

### CRUD Commands
CRUD in LARAVEL contains:
- migrations
- database
- models
- controller 
- routes
- views
```shell
php artisan make:migration create_nerds_table
php artisan make:model Nerd       #extends from Eloquent
    # Add your Model to databse factory
php artisan make:controller NerdController --resource
php artisan route:list
php artisan make:test NerdTest 
php artisan make:seeder NerdsTableSeeder
php artisan migrate --seed


php artisan serve
```

### Cache Problems
```shell
composer dump-autoload -o
php artisan route:clear
php artisan cache:clear
php artisan config:cache
php artisan route:cache
```

## Versioning

We can maybe use [SemVer](http://semver.org/) for versioning. For the versions available, see the [link to tags on this repository](/tags).


## Configuration

Here you should write what are all of the configurations a user can enter when using the project.

## Tests

Describe and show how to run the tests with code examples.
Explain what these tests test and why.

```shell
php artisan make:test CompaniesTest
```

## Style guide

Explain your code style and show how to check it.

## Api Reference

If the api is external, link to api documentation. If not describe your api including authentication methods as well as explaining all the endpoints with their required parameters.


## Database

Explaining what database (and version) has been used. Provide download links.
Documents your database design and schemas, relations etc... 


## Licensing

State what the license is and how to find the text version of the license.



# Project structure

    .
    ├── app                          # The app directory, as you might expect, contains the core code of your application. 
    │    └── Console                 # The Events directory, as you might expect, houses event classes. Events may be used to alert other parts of your application that a given action has occurred, providing a great deal of flexibility and decoupling. 
    │    └── Events                  # This directory does not exist by default, but will be created for you by the event:generate and  make:event Artisan commands.
    │    └── Exceptions              # The Exceptions directory contains your application's exception handler and is also a good place to place any exceptions thrown by your application. 
    │    └── Http                    # The Http directory contains your controllers, middleware, and form requests. 
    │    └── Jobs                    # The Jobs directory, of course, houses the queueable jobs for your application. Jobs may be queued by your application or run synchronously within the current request lifecycle.
    │    └── Listeners               # This directory does not exist by default, but will be created for you if you execute the  event:generate or make:listener Artisan commands. 
    │    └── Policies                # This directory does not exist by default, but will be created for you if you execute the make:policy Artisan command. 
    │    └── Providers               # The Providers directory contains all of the service providers for your application. 
    │
    ├── bootstrap                    # The bootstrap directory contains a few files that bootstrap the framework and configure autoloading, as well as a cache directory that contains a few framework generated files for bootstrap performance optimization. 
    │
    ├── config                       # The config directory, as the name implies, contains all of your application's configuration files.
    │
    ├── database                     # The database directory contains your database migration and seeds. 
    │
    ├── public                       # The public directory contains the front controller and your assets (images, JavaScript, CSS, etc.). 
    │
    ├── resources                    # The resources directory contains your views as well as your raw, un-compiled assets such as LESS, SASS, or JavaScript. 
    │
    ├── storage                      # The storage directory contains your compiled Blade templates, file based sessions, file caches, and other files generated by the framework. This directory is segregated into app, framework, and  logs directories.
    │    └── storage/app/public      # The storage/app/public directory may be used to store user-generated files, such as profile avatars, that should be publicly accessible. 
    │
    ├── Tests                        # The tests directory contains your automated tests. An example PHPUnit is provided out of the box. 
    │
    ├── Vendor                       # The vendor directory contains your Composer dependencies.
    │
    ├── CONTRIBUTORS.md             
    ├── composer.json 
    ├── server.php      
    ├── README.md
    └── TODO.md
    
# Miscellaneous


# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).




# MINIO S3 FILESYSTEM SETTINGS
------------------------------
###File storage disk info
``` 
disks' => [
           ... ,
           
           'minio' => [
               'driver' => 'minio',
               'key' => env('MINIO_KEY'),
               'secret' => env('MINIO_SECRET'),
               'region' => 'us-east-1',
               'bucket' => env('MINIO_BUCKET'),
               'endpoint' => env('MINIO_ENDPOINT')
           ]
       ],
```

### .env values
```
FILESYSTEM_CLOUD=minio
MINIO_KEY=F6XIAVGFEX3P1F6CE9UX
MINIO_SECRET=UdAQMtwNmv92X/NurTQiukRQWv9nNEA8OrKKB79m
MINIO_BUCKET=sigit
MINIO_ENDPOINT=http://localhost:9000
```

### RFQ files url
The file name encrypted by md5 method to create a unique name. 
```
minio/sigit/channels/_channel_id/rfqs/_rfqs_id
minio/sigit/channels/2/rfqs/5/
```

#### 1. Prerequisites

Install Minio Server from [here](https://www.minio.io/downloads.html).

#### 2. Install Required Dependency for Laravel

Install `league/flysystem` package for [`aws-s3`](https://github.com/coraxster/flysystem-aws-s3-v3-minio)  :
fork based on https://github.com/thephpleague/flysystem-aws-s3-v3
```
composer require coraxster/flysystem-aws-s3-v3-minio
```

#### 3. Create Minio Storage ServiceProvider 
    - Create `MinioStorageServiceProvider.php` file in `app/Providers/` directory with this content:
    - Register service provider by adding this line in `config/app.php` on `providers` section :  
    - Add config for minio in `disks` section of `config/filesystems.php` file :
    - Note : `region` is not required & can be set to anything.

#### 4. Use Storage with Minio in Laravel
Now you can use `disk` method on storage facade to use minio driver :  
```php
Storage::disk('minio')->put('avatars/1', $fileContents);
```
Or you can set default cloud driver to `minio` in `filesystems.php` config file :
```php
'cloud' => env('FILESYSTEM_CLOUD', 'minio'),
```