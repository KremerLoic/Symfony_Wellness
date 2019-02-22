<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190219193409 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE stage ADD organiser_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stage ADD CONSTRAINT FK_C27C9369A0631C12 FOREIGN KEY (organiser_id) REFERENCES provider (id)');
        $this->addSql('CREATE INDEX IDX_C27C9369A0631C12 ON stage (organiser_id)');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AA53A8AA');
        $this->addSql('DROP INDEX IDX_E01FBE6AA53A8AA ON images');
        $this->addSql('ALTER TABLE images DROP provider_id');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8BC665DD FOREIGN KEY (logo_provider_id) REFERENCES provider (id)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8BC665DD');
        $this->addSql('DROP INDEX UNIQ_E01FBE6A8BC665DD ON images');
        $this->addSql('ALTER TABLE images ADD provider_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AA53A8AA ON images (provider_id)');
        $this->addSql('ALTER TABLE stage DROP FOREIGN KEY FK_C27C9369A0631C12');
        $this->addSql('DROP INDEX IDX_C27C9369A0631C12 ON stage');
        $this->addSql('ALTER TABLE stage DROP organiser_id');
    }
}
