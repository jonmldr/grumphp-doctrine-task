<?php

declare(strict_types=1);

namespace JonMldr\GrumPhpDoctrineTask;

use GrumPHP\Runner\TaskResult;
use GrumPHP\Runner\TaskResultInterface;
use GrumPHP\Task\AbstractExternalTask;
use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\Context\GitPreCommitContext;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Process\Process;

class DoctrineSchemaValidateTask extends AbstractExternalTask
{
    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'doctrine_schema_validate';
    }

    public function canRunInContext(ContextInterface $context): bool
    {
        return $context instanceof GitPreCommitContext;
    }

    /**
     * {@inheritdoc}
     */
    public static function getConfigurableOptions(): OptionsResolver
    {
        return new OptionsResolver();
    }

    /**
     * {@inheritdoc}
     */
    public function run(ContextInterface $context): TaskResultInterface
    {
        $process = new Process(['php', 'bin/console', 'doctrine:schema:validate', '--skip-sync']);
        $process->run();

        if (!$process->isSuccessful()) {
            $output = $this->formatter->format($process);

            return TaskResult::createFailed($this, $context, $output);
        }

        return TaskResult::createPassed($this, $context);
    }
}
