<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230928142250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'setup';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, tp_id_id INT DEFAULT NULL, ordre INT NOT NULL, point INT NOT NULL, INDEX IDX_93872075E5EE4340 (tp_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache_utilisateur (tache_id INT NOT NULL, utilisateur_id INT NOT NULL, etat LONGTEXT NOT NULL, INDEX IDX_8E15C4FDD2235D39 (tache_id), INDEX IDX_8E15C4FDFB88E14F (utilisateur_id), PRIMARY KEY(tache_id, utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tp (id INT AUTO_INCREMENT NOT NULL, classe_id_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, INDEX IDX_5A8FDF313633CA6F (classe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, classe_id_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, courriel VARCHAR(255) NOT NULL, role VARCHAR(50) NOT NULL, INDEX IDX_1D1C63B33633CA6F (classe_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075E5EE4340 FOREIGN KEY (tp_id_id) REFERENCES tp (id)');
        $this->addSql('ALTER TABLE tache_utilisateur ADD CONSTRAINT FK_8E15C4FDD2235D39 FOREIGN KEY (tache_id) REFERENCES tache (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tache_utilisateur ADD CONSTRAINT FK_8E15C4FDFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tp ADD CONSTRAINT FK_5A8FDF313633CA6F FOREIGN KEY (classe_id_id) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B33633CA6F FOREIGN KEY (classe_id_id) REFERENCES classe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075E5EE4340');
        $this->addSql('ALTER TABLE tache_utilisateur DROP FOREIGN KEY FK_8E15C4FDD2235D39');
        $this->addSql('ALTER TABLE tache_utilisateur DROP FOREIGN KEY FK_8E15C4FDFB88E14F');
        $this->addSql('ALTER TABLE tp DROP FOREIGN KEY FK_5A8FDF313633CA6F');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B33633CA6F');
        $this->addSql('DROP TABLE classe');
        $this->addSql('DROP TABLE tache');
        $this->addSql('DROP TABLE tache_utilisateur');
        $this->addSql('DROP TABLE tp');
        $this->addSql('DROP TABLE utilisateur');
    }
}
