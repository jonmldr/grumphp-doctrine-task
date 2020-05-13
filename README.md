# Doctrine schema validation task for GrumPHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonmldr/grumphp-doctrine-task.svg?style=flat-square)](https://packagist.org/packages/jonmldr/grumphp-doctrine-task)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/jonmldr/grumphp-doctrine-task.svg?style=flat-square)](https://packagist.org/packages/jonmldr/grumphp-doctrine-task)

This library provides Doctrine's schema validation in Symfony projects as a GrumPHP task.

## Installation
You can install the package via composer:
````
composer require --dev jonmldr/grumphp-doctrine-task
````

## Configuration
````YAML
# grumphp.yml
parameters:
    tasks:
        doctrine_schema_validate: ~

services:
    task.doctrine_schema_validate:
        class: JonMldr\GrumPhpDoctrineTask\DoctrineSchemaValidateTask
        arguments:
            - '@process_builder'
            - '@formatter.raw_process'
        tags:
            - { name: grumphp.task, task: doctrine_schema_validate }
````

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
