<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250411174707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE signal_potentiel (id INT AUTO_INCREMENT NOT NULL, dmm VARCHAR(255) DEFAULT NULL, pole_long VARCHAR(255) DEFAULT NULL, pole_court VARCHAR(255) DEFAULT NULL, eval_nom VARCHAR(255) DEFAULT NULL, eval_prenom VARCHAR(255) DEFAULT NULL, substance VARCHAR(255) DEFAULT NULL, dosage VARCHAR(255) DEFAULT NULL, voie_admin VARCHAR(255) DEFAULT NULL, signal_potentiel VARCHAR(255) DEFAULT NULL, origine_signal VARCHAR(1000) DEFAULT NULL, mecanisme_action VARCHAR(255) DEFAULT NULL, exposition VARCHAR(255) DEFAULT NULL, imputabilie VARCHAR(255) DEFAULT NULL, litterature VARCHAR(255) DEFAULT NULL, essais_cliniques VARCHAR(255) DEFAULT NULL, effet_rcpautre_pays VARCHAR(255) DEFAULT NULL, das_ermr VARCHAR(255) DEFAULT NULL, score INT DEFAULT NULL, commentaire VARCHAR(1000) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', user_create VARCHAR(255) DEFAULT NULL, user_modif VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE signal_potentiel
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
