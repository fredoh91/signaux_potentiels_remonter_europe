<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414181333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE voie_admin (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD voie_admin_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A2FF16A2F5 FOREIGN KEY (voie_admin_id) REFERENCES voie_admin (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A2FF16A2F5 ON signal_potentiel (voie_admin_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A2FF16A2F5
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE voie_admin
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A2FF16A2F5 ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP voie_admin_id
        SQL);
    }
}
