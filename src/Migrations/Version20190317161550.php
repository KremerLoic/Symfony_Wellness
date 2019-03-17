<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
    final class Version20190317161550 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider ADD logo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CF98F144A FOREIGN KEY (logo_id) REFERENCES images (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_92C4739CF98F144A ON provider (logo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CF98F144A');
        $this->addSql('DROP INDEX UNIQ_92C4739CF98F144A ON provider');
        $this->addSql('ALTER TABLE provider DROP logo_id');
    }
}
