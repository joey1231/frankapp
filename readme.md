# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## APPLICATION Documentation


### Installation

git clone https://github.com/joey1231/frankapp.git

cd frankapp

composer install

chmod -R 777 bootstrap/cache storage/

create .env file

Copy the .env.example to created .env file

php artisan migrate

composer dump-autoload -o & php artisan view:clear & php artisan cache:clear



### Functions
 
| Name | Controller | Description |
| ---- | ---------- | ----------- | 
| syncAppThis() | AppController | This function call two api from appThis and offerslook to check for creating and updating offers in offerslook |
| checkDeletedOffer() | AppController | This functon call two api from appThis and offerslook to check the different and delete in offersloook if there is difference offers |

### Cron Jobs

add this to cron job * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1 to run the schedule command

### Page

 This the view page where you can see the logs and you can manually run the Syn application from thisApp to offerslook

http://screencast.com/t/RMpUupP3

