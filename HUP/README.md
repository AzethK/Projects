Step-by-step to running

https://windows.php.net/download#php-8.2 <br>
https://getcomposer.org/download/ <br>
https://nodejs.org/en/download <br>

php.ini sem ; <br>
extension=curl <br>
extension=gd <br>
extension=mbstring <br>
extension=pdo_mysql <br>
extension=fileinfo <br>
extension=zip <br>
extension=php_pgsql.dll <br>
extension=php_pdo_pgsql.dll <br>
extension=php_pdo_sqlite.dll <br>

composer create-project laravel/laravel example-app --ignore-platform-reqs <br>
composer require doctrine/dbal <br>

php artisan migrate <br>
