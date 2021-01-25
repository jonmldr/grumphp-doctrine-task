# Doctrine schema validation task for GrumPHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonmldr/grumphp-doctrine-task.svg?style=flat-square)](https://packagist.org/packages/jonmldr/grumphp-doctrine-task)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/jonmldr/grumphp-doctrine-task.svg?style=flat-square)](https://packagist.org/packages/jonmldr/grumphp-doctrine-task)

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
### Version 2.0
- Updated to GrumPHP 1.x
- Required PHP version 7.3 or higher (required by GrumPHP 1.x)
- Task is also being executed during manual run
- Option parity with [default doctrine task](https://github.com/phpro/grumphp/blob/master/doc/tasks/doctrine_orm.md)
- Added Docker file for local development
- Removed composer.lock file

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
