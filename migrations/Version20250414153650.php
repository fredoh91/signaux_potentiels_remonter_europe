<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414153650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE das_ermr (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score INT NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE effet_rcpautre_pays (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score INT NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE essais_cliniques (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score INT NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE exposition (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score INT NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE imputabilite (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score INT NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE litterature (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score INT NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE mecanisme_action (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, score INT NOT NULL, inactif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD mecanisme_action_id INT DEFAULT NULL, ADD exposition_id INT DEFAULT NULL, ADD imputabilite_id INT DEFAULT NULL, ADD litterature_id INT DEFAULT NULL, ADD essais_cliniques_id INT DEFAULT NULL, ADD effet_rcpautre_pays_id INT DEFAULT NULL, ADD das_ermr_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A21C6A2930 FOREIGN KEY (mecanisme_action_id) REFERENCES mecanisme_action (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A288ED476F FOREIGN KEY (exposition_id) REFERENCES exposition (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A2E90D5DEB FOREIGN KEY (imputabilite_id) REFERENCES imputabilite (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A237BA683B FOREIGN KEY (litterature_id) REFERENCES litterature (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A25302E0EF FOREIGN KEY (essais_cliniques_id) REFERENCES essais_cliniques (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A2174A5F62 FOREIGN KEY (effet_rcpautre_pays_id) REFERENCES effet_rcpautre_pays (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD CONSTRAINT FK_F2DBB3A256772D23 FOREIGN KEY (das_ermr_id) REFERENCES das_ermr (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A21C6A2930 ON signal_potentiel (mecanisme_action_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A288ED476F ON signal_potentiel (exposition_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A2E90D5DEB ON signal_potentiel (imputabilite_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A237BA683B ON signal_potentiel (litterature_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A25302E0EF ON signal_potentiel (essais_cliniques_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A2174A5F62 ON signal_potentiel (effet_rcpautre_pays_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_F2DBB3A256772D23 ON signal_potentiel (das_ermr_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A256772D23
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A2174A5F62
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A25302E0EF
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A288ED476F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A2E90D5DEB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A237BA683B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP FOREIGN KEY FK_F2DBB3A21C6A2930
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE das_ermr
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE effet_rcpautre_pays
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE essais_cliniques
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE exposition
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE imputabilite
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE litterature
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE mecanisme_action
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A21C6A2930 ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A288ED476F ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A2E90D5DEB ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A237BA683B ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A25302E0EF ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A2174A5F62 ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_F2DBB3A256772D23 ON signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP mecanisme_action_id, DROP exposition_id, DROP imputabilite_id, DROP litterature_id, DROP essais_cliniques_id, DROP effet_rcpautre_pays_id, DROP das_ermr_id
        SQL);
    }
}
