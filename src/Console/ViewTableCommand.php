<?php

namespace App\Console;

use PDO;
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
    private PDO $pdo;

    /**
     * The constructor.
     *
     * @param PDO $pdo The database connection
     * @param string|null $name The name
     */
    public function __construct(PDO $pdo, ?string $name = null)
    {
        parent::__construct($name);
        $this->pdo = $pdo;
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
        $output->writeln(sprintf('Use database: %s', (string)$this->query('select database()')->fetchColumn()));

        $statement = $this->query(
            "SELECT * FROM users"
        );
        $list = [];
        while ($rows = $statement->fetch(PDO::FETCH_ASSOC)) {
            $list[] = $rows;
        }

        $headers = ['id', 'first_name', 'last_name'];
        $body = [];
        foreach ($list as $key => $value) {
                $body[] = $value;
        }

        $io->table($headers, $body);

        // The error code, 0 on success
        return 0;
    }

    private function query(string $sql): PDOStatement
    {
        $statement = $this->pdo->query($sql);

        if (!$statement) {
            throw new \Exception('Query failed');
        }

        return $statement;
    }
}
