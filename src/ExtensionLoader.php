<?php

declare(strict_types=1);

namespace JonMldr\GrumPhpDoctrineTask;

use GrumPHP\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExtensionLoader implements ExtensionInterface
{
    public function load(ContainerBuilder $container): void
    {
        $container->register('task.doctrine_schema_validate', DoctrineSchemaValidateTask::class)
            ->addArgument(new Reference('process_builder'))
            ->addArgument(new Reference('formatter.raw_process'))
            ->addTag('grumphp.task', ['task' => 'doctrine_schema_validate']);
    }
}
