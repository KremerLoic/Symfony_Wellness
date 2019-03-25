<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325183724 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64988823A92');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499CEB97F7');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64988823A92 FOREIGN KEY (locality_id) REFERENCES locality (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499CEB97F7 FOREIGN KEY (zip_code_id) REFERENCES zip_code (id) ON DELETE SET NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499CEB97F7');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64988823A92');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499CEB97F7 FOREIGN KEY (zip_code_id) REFERENCES zip_code (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64988823A92 FOREIGN KEY (locality_id) REFERENCES locality (id)');
    }
}