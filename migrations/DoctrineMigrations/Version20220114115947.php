<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114115947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE TABLE `users` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `username` (`username`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE IF EXISTS users");

    }
}
