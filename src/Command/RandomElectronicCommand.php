<?php

namespace App\Command;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class RandomElectronicCommand extends Command
{
    protected static $defaultName = 'app:random-electronic';
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Get a random component!')
            ->addArgument('your-name', InputArgument::OPTIONAL, 'Your name')
            ->addOption('yell', null, InputOption::VALUE_NONE, 'Yell?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $yourName = $input->getArgument('your-name');

        if ($yourName) {
            $io->note(sprintf('Hi %s!', $yourName));
        }

        $electricalComponents = [
            'resistor',
            'transistor',
            'condenser',
            'operational amplifier',
            'circuit board',
            'diode',
            'coil',
        ];

        $component = $electricalComponents[array_rand($electricalComponents)];

        if ($input->getOption('yell')) {
            $component = strtoupper($component);
        }

        $this->logger->info('Get an electronic component: '.$component);

        $io->success($component);

        return 0;
    }
}
