<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221211195949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_enexse (userid VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, fullname VARCHAR(100) NOT NULL, gender VARCHAR(100) NOT NULL, user_adress VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', date_of_birth DATE NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_contact VARCHAR(14) NOT NULL, PRIMARY KEY(userid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (userid VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, fullname VARCHAR(100) NOT NULL, gender VARCHAR(100) NOT NULL, user_adress VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', date_of_birth DATE NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_contact VARCHAR(14) NOT NULL, PRIMARY KEY(userid)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_enexse');
        $this->addSql('DROP TABLE users');
    }
}
