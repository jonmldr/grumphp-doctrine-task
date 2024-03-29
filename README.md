# Doctrine schema validation task for GrumPHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonmldr/grumphp-doctrine-task.svg?style=flat-square)](https://packagist.org/packages/jonmldr/grumphp-doctrine-task)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/jonmldr/grumphp-doctrine-task.svg?style=flat-square)](https://packagist.org/packages/jonmldr/grumphp-doctrine-task)
[![PHP Version Support](https://img.shields.io/packagist/php-v/jonmldr/grumphp-doctrine-task.svg?style=flat-square)](https://packagist.org/packages/jonmldr/grumphp-doctrine-task)

This library provides Doctrine's schema validation in Symfony projects as a GrumPHP task.
> Note: this task is made for Symfony projects, it uses 'bin/console' so you don't have to configure the Doctrine CLI.

## Demo
<img src="https://user-images.githubusercontent.com/33514542/81804148-f9261e00-9518-11ea-8e92-d04d482b45ff.gif" alt="demo" width="100%" />

## Installation
You can install the package via composer:
````
composer require --dev jonmldr/grumphp-doctrine-task
````

## Configuration
````YAML
# grumphp.yml
grumphp:
    tasks:
        doctrine_schema_validate:
            skip_mapping: false
            skip_sync: false
            triggered_by: ['php', 'xml', 'yml']
    extensions:
        - JonMldr\GrumPhpDoctrineTask\ExtensionLoader
````

**console_path**

*Default: 'bin/console'*

With this parameter you can set the path of the console to be used.

**skip_mapping**

*Default: false*

With this parameter you can skip the mapping validation check.

**skip_sync**

*Default: false*

With this parameter you can skip checking if the mapping is in sync with the database.

**triggered_by**

*Default: [php, xml, yml]*

This is a list of extensions that should trigger the Doctrine task.

## Changelog
### Version 3.0
- Upgraded GrumPHP version to `^2.0` [@erkens](https://github.com/erkens)
- Upgraded to new `ExtensionInterface` for GrumPHP 2.x [@erkens](https://github.com/erkens)
- Changed minimum PHP version to `8.1` [@erkens](https://github.com/erkens)

### Version 2.1
- Added PHP8 support
- Added `ExtensionLoader`, see [Configuration](#Configuration).
The service definition can be removed if you add the ExtensionLoader to your `grumphp.yml`
- Added the `console_path` option

### Version 2.0
- Updated to GrumPHP 1.x
- Required PHP version 7.3 or higher (required by GrumPHP 1.x)
- Task is also being executed during manual run
- Option parity with [default doctrine task](https://github.com/phpro/grumphp/blob/master/doc/tasks/doctrine_orm.md)
- Added Docker file for local development
- Removed composer.lock file

## Supporters
[![Stargazers repo roster for @jonmldr/grumphp-doctrine-task](https://reporoster.com/stars/jonmldr/grumphp-doctrine-task)](https://github.com/jonmldr/grumphp-doctrine-task/stargazers)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
