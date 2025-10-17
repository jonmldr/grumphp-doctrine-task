<?php

declare(strict_types=1);

namespace JonMldr\GrumPhpDoctrineTask;

use GrumPHP\Runner\TaskResult;
use GrumPHP\Runner\TaskResultInterface;
use GrumPHP\Task\AbstractExternalTask;
use GrumPHP\Task\Config\ConfigOptionsResolver;
use GrumPHP\Task\Context\ContextInterface;
use GrumPHP\Task\Context\GitPreCommitContext;
use GrumPHP\Task\Context\RunContext;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        return $context instanceof GitPreCommitContext || $context instanceof RunContext;
    }

    /**
     * {@inheritdoc}
     */
    public static function getConfigurableOptions(): ConfigOptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'console_path' => 'bin/console',
            'skip_mapping' => false,
            'skip_sync' => false,
            'skip_property_types' => false,
            'em' => null,
            'triggered_by' => ['php', 'xml', 'yml'],
        ]);

        $resolver->addAllowedTypes('skip_mapping', ['bool'])
            ->addAllowedTypes('skip_sync', ['bool'])
            ->addAllowedTypes('skip_property_types', ['bool'])
            ->addAllowedTypes('triggered_by', ['array'])
            ->addAllowedTypes('em', ['null', 'string']);

        return ConfigOptionsResolver::fromClosure(
            static fn (array $options): array => $resolver->resolve($options)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function run(ContextInterface $context): TaskResultInterface
    {
        $config = $this->getConfig()->getOptions();
        $files = $context->getFiles()->extensions($config['triggered_by']);

        if (0 === \count($files)) {
            return TaskResult::createSkipped($this, $context);
        }

        $arguments = $this->processBuilder->createArgumentsForCommand('php');
        $arguments->add($config['console_path']);
        $arguments->add('doctrine:schema:validate');
        $arguments->addOptionalArgument('--skip-mapping', $config['skip_mapping']);
        $arguments->addOptionalArgument('--skip-sync', $config['skip_sync']);
        $arguments->addOptionalArgument('--skip-property-types', $config['skip_property_types']);
        $em = $config['em'] ?? null;
        if ($em !== null) {
            $arguments->addOptionalArgument('--em', $em);
        }

        $process = $this->processBuilder->buildProcess($arguments);
        $process->run();

        if (!$process->isSuccessful()) {
            $output = $this->formatter->format($process);

            return TaskResult::createFailed($this, $context, $output);
        }

        return TaskResult::createPassed($this, $context);
    }
}
