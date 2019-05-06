# Laravel/Lumen Snowflake
[![Build Status](https://travis-ci.org/maxsky/laravel-snowflake.svg?branch=master)](https://travis-ci.org/maxsky/laravel-snowflake)
[![Latest Stable Version](https://poser.pugx.org/maxsky/laravel-snowflake/v/stable)](https://packagist.org/packages/maxsky/laravel-snowflake)
[![License](https://poser.pugx.org/kra8/laravel-snowflake/license)](https://packagist.org/packages/kra8/laravel-snowflake)
<a href="https://996.icu"><img src="https://img.shields.io/badge/link-996.icu-red.svg"></a>

This Laravel/Lumen package to generate 64 bit identifier like the snowflake within Twitter.



# Installation

```bash
composer require "maxsky/laravel-snowflake"

# Just used with Laravel
php artisan vendor:publish --provider="Snowflake\SnowflakeServiceProvider"
```



# Configuration

If `config/snowflake.php` not exist, run below:

```bash
# Just Laravel
php artisan vendor:publish
```

If used Lumen framework, please copy `vendor/maxsky/laravel-snowflake/config/snowflake.php` file to `config` folder.

And then add some environment config in `.env` file (if you used):

```php
SNOWFLAKE_EPOCH='2019-05-01 00:00:00'
SNOWFLAKE_WORKER_ID=1
SNOWFLAKE_DATACENTER_ID=1
```



# Usage

Get instance

```php
$snowflake = app('Snowflake\Snowflake');
```

Generate snowflake identifier

```php
$id = $snowflake->next();
```



# Usage with Eloquent

Add the `Snowflake\HasSnowflakePrimary` trait to your Eloquent model.
This trait make type `snowflake` of primary key.  Don't forget to set the Auto increment property to false.

```php
<?php

namespace App;

use Snowflake\HasSnowflakePrimary;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use HasSnowflakePrimary, Notifiable;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
```

Finally, in migrations, set the primary key to `bigInteger` and `primary`.

```php
/**
 * Run the migrations.
 *
 * @return void
 */
public function up() {
    Schema::create('users', function (Blueprint $table) {
        // $table->increments('id');
        $table->bigInteger('id')->primary();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
    });
}
```



# License

[MIT License](https://github.com/kra8/laravel-snowflake/blob/master/LICENSE) From [Kra8](https://github.com/kra8/laravel-snowflake).