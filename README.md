# Doctrine schema validation task for GrumPHP

## Installation
````
composer require jonmldr/grumphp-doctrine-task
````

## Configuration
````YAML
services:
    task.doctrine_schema_validate:
        class: JonMldr\GrumPhpDoctrineTask\DoctrineSchemaValidateTask
        arguments:
            - '@process_builder'
            - '@formatter.raw_process'
        tags:
            - { name: grumphp.task, task: doctrine_schema_validate }
````
