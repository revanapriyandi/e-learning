<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Installation

Create a Database Table in phpMyAdmin

Extract the LaraELearn Source Code that has been downloaded to a folder anywhere.

Open Code Editor → Terminal.

In Terminal, navigate to the extracted LaraELearn folder. $ cd e-learning

Enter these commands one by one (without the $ sign),

<code>DB_HOST = 127.0.0.1 // change to Host your database
DB_PORT = 3306
DB_DATABASE = e-learning // change to the name of the database table that you created
DB_USERNAME = root // change to be your database username, default root
DB_PASSWORD = ... // change to your databse password, null default 
</code>
Edit the .env file like this,

DB_HOST = 127.0.0.1 // change to Host your database
DB_PORT = 3306
DB_DATABASE = e-learning // change to the name of the database table that you created
DB_USERNAME = root // change to be your database username, default root
DB_PASSWORD = ... // change to your databse password, null default 
Run this command for Seed : $ php artisan migrate --seed

Done 😉, to run LaraELearn enter the command below: $ php artisan serve

Then open the browser, and enter the url: http://localhost:8000

or if you want to run on another port, use the command: $ php artisan serve --port: 627 // e.g. the port is "627"

Thank you, Good Luck ... 😁

## The Accounts on seeder:
Admin Account - Username: admin, Password: admin
