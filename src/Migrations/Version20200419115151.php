<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200419115151 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adres (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, city VARCHAR(50) NOT NULL, street VARCHAR(50) DEFAULT NULL, housing_number VARCHAR(10) DEFAULT NULL, postal VARCHAR(7) DEFAULT NULL, INDEX IDX_50C7CAEE19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimate (id INT AUTO_INCREMENT NOT NULL, adres_id INT DEFAULT NULL, client_id INT NOT NULL, name VARCHAR(50) NOT NULL, description VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_D2EA4607F128501D (adres_id), INDEX IDX_D2EA460719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estimate_service (id INT AUTO_INCREMENT NOT NULL, estimate_id INT NOT NULL, service_id INT NOT NULL, date DATE DEFAULT NULL, unit_price DOUBLE PRECISION NOT NULL, amount DOUBLE PRECISION NOT NULL, INDEX IDX_FC21262885F23082 (estimate_id), INDEX IDX_FC212628ED5CA9E6 (service_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, unit_id INT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, INDEX IDX_E19D9AD2F8BD700D (unit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adres ADD CONSTRAINT FK_50C7CAEE19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE estimate ADD CONSTRAINT FK_D2EA4607F128501D FOREIGN KEY (adres_id) REFERENCES adres (id)');
        $this->addSql('ALTER TABLE estimate ADD CONSTRAINT FK_D2EA460719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE estimate_service ADD CONSTRAINT FK_FC21262885F23082 FOREIGN KEY (estimate_id) REFERENCES estimate (id)');
        $this->addSql('ALTER TABLE estimate_service ADD CONSTRAINT FK_FC212628ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE estimate DROP FOREIGN KEY FK_D2EA4607F128501D');
        $this->addSql('ALTER TABLE adres DROP FOREIGN KEY FK_50C7CAEE19EB6921');
        $this->addSql('ALTER TABLE estimate DROP FOREIGN KEY FK_D2EA460719EB6921');
        $this->addSql('ALTER TABLE estimate_service DROP FOREIGN KEY FK_FC21262885F23082');
        $this->addSql('ALTER TABLE estimate_service DROP FOREIGN KEY FK_FC212628ED5CA9E6');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2F8BD700D');
        $this->addSql('DROP TABLE adres');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE estimate');
        $this->addSql('DROP TABLE estimate_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE unit');
    }
}
