<?php declare(strict_types=1);

// TO DELETE

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190218232129 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A4C44476');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8BC665DD');
        $this->addSql('ALTER TABLE images DROP INDEX IDX_E01FBE6A4C44476');
        $this->addSql('ALTER TABLE images DROP INDEX IDX_E01FBE6A8BC665DD');

    }
}
