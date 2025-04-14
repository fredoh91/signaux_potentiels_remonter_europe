<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250414152517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel DROP mecanisme_action, DROP exposition, DROP imputabilie, DROP litterature, DROP essais_cliniques, DROP effet_rcpautre_pays, DROP das_ermr
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE signal_potentiel ADD mecanisme_action VARCHAR(255) DEFAULT NULL, ADD exposition VARCHAR(255) DEFAULT NULL, ADD imputabilie VARCHAR(255) DEFAULT NULL, ADD litterature VARCHAR(255) DEFAULT NULL, ADD essais_cliniques VARCHAR(255) DEFAULT NULL, ADD effet_rcpautre_pays VARCHAR(255) DEFAULT NULL, ADD das_ermr VARCHAR(255) DEFAULT NULL
        SQL);
    }
}
