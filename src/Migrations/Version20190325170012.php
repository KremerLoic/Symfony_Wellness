<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325170012 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE surfer DROP FOREIGN KEY FK_26ABE1047E9E4C8C');
        $this->addSql('ALTER TABLE surfer ADD CONSTRAINT FK_26ABE1047E9E4C8C FOREIGN KEY (photo_id) REFERENCES images (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE surfer DROP FOREIGN KEY FK_26ABE1047E9E4C8C');
        $this->addSql('ALTER TABLE surfer ADD CONSTRAINT FK_26ABE1047E9E4C8C FOREIGN KEY (photo_id) REFERENCES images (id) ON DELETE CASCADE');
    }
}
