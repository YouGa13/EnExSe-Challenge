<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221209215927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON users');
        $this->addSql('ALTER TABLE users ADD userid VARCHAR(255) NOT NULL, DROP id');
        $this->addSql('ALTER TABLE users ADD PRIMARY KEY (userid)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `PRIMARY` ON users');
        $this->addSql('ALTER TABLE users ADD id INT NOT NULL, DROP userid');
        $this->addSql('ALTER TABLE users ADD PRIMARY KEY (id)');
    }
}
