<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## About Laravel Dummy Project

Laravel Dummy Project, is a new starter pack before you start the project. Included :

-   [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v4/introduction)
-   [Spatie Activity Log](https://spatie.be/docs/laravel-activitylog/v4/introduction)
-   Simple Users Management

This project was updated from laravel 8 to laravel 9 framework. If you want to know about Laravel, please read below.

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

-   [Simple, fast routing engine](https://laravel.com/docs/routing).
-   [Powerful dependency injection container](https://laravel.com/docs/container).
-   Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
-   Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
-   Database agnostic [schema migrations](https://laravel.com/docs/migrations).
-   [Robust background job processing](https://laravel.com/docs/queues).
-   [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Security Vulnerabilities

If you discover a security vulnerability within this project, please send an e-mail to Sancaweb via [sanca.snake@gmail.com](mailto:sanca.snake@gmail.com) or [hery@sancaweb.com](mailto:hery@sancaweb.com). All security vulnerabilities will be promptly addressed.

## License

Laravel 8 Dummy Project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Roles & Permissions

This project have Roles & Permissions management. You can freely set the permissions to be assigned to the role. In this project, "super admin" role respond true to all permissions. If you want to deactivate this feature, please go to "app/Providers/AuthServiceProvider.php" and comment "GATE" in boot() function. After that, you must reconfiguring route. You can look in the file "userseeder.php" to find out the user, role and permissions that have been created
