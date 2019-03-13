<?php

namespace AppBundle\Command;

use AppBundle\Entity\Package;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SeedCategoryPlaceholdersCommand
 * @package AppBundle\Command
 */
class DependencyCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:add-dependency')
            ->setDescription('This command will add dependency in package.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $package = new Package();
        $package->addDependency($package);
        $output->writeln('Package created successfully');
    }
}
