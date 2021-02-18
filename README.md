
<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## User Interface for Spatie Laravel Permissions

The **Permissions UI** project is shows an approach to creating a User Interface (UI) for the Spatie Laravel Permissions package.  You can find this here:

https://spatie.be/docs/laravel-permission/v3/introduction

**Permissions UI** was created with Laravel Version 8.x and includes the following packages:
- Laravel Breeze (https://github.com/laravel/breeze)
- Laravel Passport (https://laravel.com/docs/8.x/passport)
- Laravel Collective Forms & HTML (https://laravelcollective.com/docs/6.x/html)

### Installation
1. Begin by cloning this project to your system:

    `git clone https://github.com/mpemburn/permissions_ui.git`

2. Change to the `permissions_ui` directory. 
3. Copy the file `.env.example` to `.env`.
4. Create a local database. By default, this will be called `permissions_ui`.  You can name it whatever you like, but you'll need to change the `DB_DATABASE` value in `.env` to match.
5. Create the data tables by running `php artisan migrate`.
6. Run `composer install` to pull in the PHP packages and dependencies.
7. Create the application key by running `php artisan key:generate`.
8. Install Passport by running `php artisan passport:install`.
9. Install `npm` in the project by running `npm install`. NOTE: If `npm` is not installed, you can get it here: https://www.npmjs.com/get-npm
10. Compile the Javascript and CSS assets by running `npm run dev`.

### Running
There are a number of ways to run this project on your local system this simplest is to use Laravel's `artisan` server:
1. Go to your project's root (the `permissions_ui` directory) and run `php artisan serve`.  It should say:

    **Starting Laravel development server:** `http://127.0.0.1:8000`
2. Browse to `http://127.0.0.1:8000`. You should see this README page.

Another Laravel-friendly way to run the project with a few more sophisticated options is Larvel Valet.  You can get this here:

https://laravel.com/docs/8.x/valet
























### License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
