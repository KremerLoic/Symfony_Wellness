<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190221223745 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        /*$this->addSql('CREATE UNIQUE INDEX UNIQ_249A5903E7927C74 ON temp_user (email)');*/
       /* $this->addSql('ALTER TABLE comments ADD surfer_id INT DEFAULT NULL');*/
       /* $this->addSql('ALTER TABLE comments ADD CONSTRAINT FK_5F9E962A6729D507 FOREIGN KEY (surfer_id) REFERENCES surfer (id)');*/
       /* $this->addSql('CREATE INDEX IDX_5F9E962A6729D507 ON comments (surfer_id)');*/
       /* $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');*/
       /* $this->addSql('CREATE UNIQUE INDEX UNIQ_92C4739C99A26CD5 ON provider (email_provider)');*/
        /*$this->addSql('ALTER TABLE images DROP INDEX FK_E01FBE6A8BC665DD, ADD UNIQUE INDEX UNIQ_E01FBE6A8BC665DD (logo_provider_id)');*/
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comments DROP FOREIGN KEY FK_5F9E962A6729D507');
        $this->addSql('DROP INDEX IDX_5F9E962A6729D507 ON comments');
        $this->addSql('ALTER TABLE comments DROP surfer_id');
        $this->addSql('ALTER TABLE images DROP INDEX UNIQ_E01FBE6A8BC665DD, ADD INDEX FK_E01FBE6A8BC665DD (logo_provider_id)');
        $this->addSql('DROP INDEX UNIQ_92C4739C99A26CD5 ON provider');
        $this->addSql('DROP INDEX UNIQ_249A5903E7927C74 ON temp_user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
