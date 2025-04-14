<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414110027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE direction (id INT AUTO_INCREMENT NOT NULL, libelle_long VARCHAR(255) NOT NULL, libelle_court VARCHAR(255) NOT NULL, inactif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pole (id INT AUTO_INCREMENT NOT NULL, direction_id INT DEFAULT NULL, libelle_long VARCHAR(255) NOT NULL, libelle_court VARCHAR(255) NOT NULL, inactif TINYINT(1) DEFAULT NULL, INDEX IDX_FD6042E1AF73D997 (direction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pole ADD CONSTRAINT FK_FD6042E1AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD direction_id INT DEFAULT NULL, ADD pole_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A2AF73D997 FOREIGN KEY (direction_id) REFERENCES direction (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A2419C3385 FOREIGN KEY (pole_id) REFERENCES pole (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_F2DBB3A2AF73D997 ON signal_potentiel (direction_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_F2DBB3A2419C3385 ON signal_potentiel (pole_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A2AF73D997
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A2419C3385
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pole DROP FOREIGN KEY FK_FD6042E1AF73D997
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE direction
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pole
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_F2DBB3A2AF73D997 ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_F2DBB3A2419C3385 ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP direction_id, DROP pole_id
        SQL);
    }
}
