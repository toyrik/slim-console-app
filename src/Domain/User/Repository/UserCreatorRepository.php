<?php

namespace App\Domain\User\Repository;

use Doctrine\DBAL\Connection;

/**
 * Repository.
 */
final class UserCreatorRepository
{
    /**
     * @var Connection The database connection
     */
    private $connection;

    /**
     * The constructor.
     *
     * @param Connection $connection The database connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert user row.
     *
     * @param array $user The user
     *
     * @return int The new ID
     */
    public function insertUser(array $user): int
    {
        $query = $this->connection->createQueryBuilder();

        $row = [
            'username' => '"'. $user['username'] .'"',
            'first_name' => '"'. $user['first_name'] .'"',
            'last_name' => '"'. $user['last_name'] .'"',
            'email' => '"'. $user['email'] .'"',
        ];

        try{
            $query->insert('users')
                ->values($row)
                ->executeStatement();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }


        return (int)$this->connection->lastInsertId();
    }
}
