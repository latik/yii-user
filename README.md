yii-user
========

Yii 1.* for registration and management users accounts.

Features:
* Login from User Name or Email
* Registration
* Password recovery  (send email)
* Manage Users

Installation
=====================

Download using composer
--------

```bash
$ php composer.phar require latik/yii-user:dev-master
```

Configure app
---------

Change your config main:

```php
    'aliases' => array(
        'vendor' => realpath(__DIR__ . '/../../vendor')
    ),

    'import' => array(
    #...
        'vendor.latik.yii-user.models.*',
        'vendor.latik.yii-user.components.*',
    ),

    'modules'=>array(
    #...
        'user' => array(
            'class' => 'vendor.latik.yii-user.UserModule',
         ),
    ),

    'components'=>array(
    #....
    'user' => array(
        'class' => 'WebUser',
        'allowAutoLogin' => false,
        'loginUrl' => ['/user/login'],
        'autoUpdateFlash' => false
    ),
```

Updating database schema
-------

Run command:

```bash
    yiic migrate --migrationPath=vendor.latik.yii-user.migrations
```
