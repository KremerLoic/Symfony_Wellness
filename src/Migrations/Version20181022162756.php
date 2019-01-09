<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181022162756 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE provider ADD CONSTRAINT FK_92C4739CBF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A4C44476 FOREIGN KEY (photo_provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AA53A8AA');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A4C44476');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A4C44476 FOREIGN KEY (photo_provider_id) REFERENCES provider (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('ALTER TABLE provider DROP FOREIGN KEY FK_92C4739CBF396750');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AA53A8AA');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A4C44476');
    }
}
