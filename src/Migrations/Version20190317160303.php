<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190317160303 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8BC665DD');
        $this->addSql('DROP INDEX IDX_E01FBE6A8BC665DD ON images');
        $this->addSql('ALTER TABLE images DROP logo_provider_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');


        $this->addSql('ALTER TABLE images ADD logo_provider_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8BC665DD FOREIGN KEY (logo_provider_id) REFERENCES provider (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8BC665DD ON images (logo_provider_id)');
    }
}
