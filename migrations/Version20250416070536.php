<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416070536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE direction_pole (id INT AUTO_INCREMENT NOT NULL, libelle_dmm_long VARCHAR(255) NOT NULL, libelle_dmm_court VARCHAR(255) NOT NULL, libelle_pole_long VARCHAR(255) NOT NULL, libelle_pole_court VARCHAR(255) NOT NULL, inactif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD direction_pole_id INT DEFAULT NULL, DROP voie_admin
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A2D0CB24A0 FOREIGN KEY (direction_pole_id) REFERENCES direction_pole (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A2D0CB24A0 ON signal_potentiel (direction_pole_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A2D0CB24A0
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE direction_pole
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A2D0CB24A0 ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD voie_admin VARCHAR(255) DEFAULT NULL, DROP direction_pole_id
        SQL);
    }
}
