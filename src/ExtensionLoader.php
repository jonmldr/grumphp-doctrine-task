<?php

declare(strict_types=1);

namespace JonMldr\GrumPhpDoctrineTask;

use GrumPHP\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ExtensionLoader implements ExtensionInterface
{
    public function imports(): iterable
    {
        $configDir = dirname(__DIR__) . '/config';

        yield $configDir . '/doctrine-task-extension.yaml';
    }
}
