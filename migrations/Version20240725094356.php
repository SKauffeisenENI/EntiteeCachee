<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725094356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe_mot_mystere (equipe_id INT NOT NULL, mot_mystere_id INT NOT NULL, INDEX IDX_C95CECDD6D861B89 (equipe_id), INDEX IDX_C95CECDD327B4E7 (mot_mystere_id), PRIMARY KEY(equipe_id, mot_mystere_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipe_mot_mystere ADD CONSTRAINT FK_C95CECDD6D861B89 FOREIGN KEY (equipe_id) REFERENCES equipe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe_mot_mystere ADD CONSTRAINT FK_C95CECDD327B4E7 FOREIGN KEY (mot_mystere_id) REFERENCES mot_mystere (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipe_mot_mystere DROP FOREIGN KEY FK_C95CECDD6D861B89');
        $this->addSql('ALTER TABLE equipe_mot_mystere DROP FOREIGN KEY FK_C95CECDD327B4E7');
        $this->addSql('DROP TABLE equipe_mot_mystere');
    }
}
