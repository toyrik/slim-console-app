<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114132353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            "INSERT INTO `users` (`username`, `email`, `first_name`, `last_name`) VALUES
            ('podriv.ustoev', 'podriv.ustoev@email.com', 'Подрыв', 'Устоев'),
            ('zahvat.pokoev', 'zahvat.pokoev@email.com', 'Захват', 'Покоев'),
            ('ulov.calmarov', 'ulov.calmarov@email.com', 'Улов', 'Кальмаров'),
            ('rulon.oboev', 'rulon.oboev@email.com', 'Рулон', 'Обоев')"
        );

    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            "DELETE FROM `users` WHERE `id` > 5"
        );

    }
}
