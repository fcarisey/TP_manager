<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231116084438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe CHANGE designation designation VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075E5EE4340');
        $this->addSql('DROP INDEX IDX_93872075E5EE4340 ON tache');
        $this->addSql('ALTER TABLE tache ADD tp_id INT NOT NULL, DROP tp_id_id, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075384F0DAC FOREIGN KEY (tp_id) REFERENCES tp (id)');
        $this->addSql('CREATE INDEX IDX_93872075384F0DAC ON tache (tp_id)');
        $this->addSql('ALTER TABLE tache_utilisateur DROP FOREIGN KEY FK_8E15C4FDD2235D39');
        $this->addSql('ALTER TABLE tache_utilisateur DROP FOREIGN KEY FK_8E15C4FDFB88E14F');
        $this->addSql('ALTER TABLE tache_utilisateur ADD id INT AUTO_INCREMENT NOT NULL, CHANGE etat etat VARCHAR(50) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE tache_utilisateur ADD CONSTRAINT FK_8E15C4FDD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE tache_utilisateur ADD CONSTRAINT FK_8E15C4FDFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE tp DROP FOREIGN KEY FK_5A8FDF313633CA6F');
        $this->addSql('DROP INDEX IDX_5A8FDF313633CA6F ON tp');
        $this->addSql('ALTER TABLE tp CHANGE fichier fichier LONGBLOB DEFAULT NULL, CHANGE classe_id_id classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tp ADD CONSTRAINT FK_5A8FDF318F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_5A8FDF318F5EA509 ON tp (classe_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B33633CA6F');
        $this->addSql('DROP INDEX IDX_1D1C63B33633CA6F ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE classe_id_id classe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B38F5EA509 ON utilisateur (classe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classe CHANGE designation designation VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075384F0DAC');
        $this->addSql('DROP INDEX IDX_93872075384F0DAC ON tache');
        $this->addSql('ALTER TABLE tache ADD tp_id_id INT DEFAULT NULL, DROP tp_id, CHANGE description description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075E5EE4340 FOREIGN KEY (tp_id_id) REFERENCES tp (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_93872075E5EE4340 ON tache (tp_id_id)');
        $this->addSql('ALTER TABLE tache_utilisateur MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE tache_utilisateur DROP FOREIGN KEY FK_8E15C4FDD2235D39');
        $this->addSql('ALTER TABLE tache_utilisateur DROP FOREIGN KEY FK_8E15C4FDFB88E14F');
        $this->addSql('DROP INDEX `PRIMARY` ON tache_utilisateur');
        $this->addSql('ALTER TABLE tache_utilisateur DROP id, CHANGE etat etat LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE tache_utilisateur ADD CONSTRAINT FK_8E15C4FDD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache_utilisateur ADD CONSTRAINT FK_8E15C4FDFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache_utilisateur ADD PRIMARY KEY (tache_id, utilisateur_id)');
        $this->addSql('ALTER TABLE tp DROP FOREIGN KEY FK_5A8FDF318F5EA509');
        $this->addSql('DROP INDEX IDX_5A8FDF318F5EA509 ON tp');
        $this->addSql('ALTER TABLE tp CHANGE fichier fichier VARCHAR(255) DEFAULT NULL, CHANGE classe_id classe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tp ADD CONSTRAINT FK_5A8FDF313633CA6F FOREIGN KEY (classe_id_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5A8FDF313633CA6F ON tp (classe_id_id)');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B38F5EA509');
        $this->addSql('DROP INDEX IDX_1D1C63B38F5EA509 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE classe_id classe_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B33633CA6F FOREIGN KEY (classe_id_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1D1C63B33633CA6F ON utilisateur (classe_id_id)');
    }
}
