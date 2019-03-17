<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190317195807 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE surfer ADD photo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE surfer ADD CONSTRAINT FK_26ABE1047E9E4C8C FOREIGN KEY (photo_id) REFERENCES images (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_26ABE1047E9E4C8C ON surfer (photo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE surfer DROP FOREIGN KEY FK_26ABE1047E9E4C8C');
        $this->addSql('DROP INDEX UNIQ_26ABE1047E9E4C8C ON surfer');
        $this->addSql('ALTER TABLE surfer DROP photo_id');
    }
}
