<?php

namespace App\Console;

use Doctrine\DBAL\Connection;
use PDOStatement;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Command.
 */
final class ViewTableCommand extends Command
{
    private Connection $connection;

    /**
     * The constructor.
     *
     * @param Connection $connection The database connection
     * @param string|null $name The name
     */
    public function __construct(Connection $connection, ?string $name = null)
    {
        parent::__construct($name);
        $this->connection = $connection;
    }

    /**
     * Configure.
     *
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName('view-table');
        $this->setDescription('A sample command');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {   $io = new SymfonyStyle($input, $output);

        $queryBuilder = $this->connection->createQueryBuilder();

        $output->writeln(sprintf('Use database: %s', (string)$this->connection->getDatabase()));


        $list = $queryBuilder
            ->select("*")->from('users')->fetchAllAssociative();

        $headers = ['id', 'name', 'email', 'first_name', 'lastname'];
        $body = [];
        foreach ($list as $value) {
            $body[] = $value;
        }

        $io->table($headers, $body);

        // The error code, 0 on success
        return 0;
    }
}
