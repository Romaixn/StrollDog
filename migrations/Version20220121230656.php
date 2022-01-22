<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220121230656 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE place_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE place (id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, postal_code VARCHAR(5) NOT NULL, country VARCHAR(255) DEFAULT NULL, longitude VARCHAR(255) NOT NULL, latitude VARCHAR(255) NOT NULL, ratings DOUBLE PRECISION DEFAULT NULL, influx VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_place (type_id INT NOT NULL, place_id INT NOT NULL, PRIMARY KEY(type_id, place_id))');
        $this->addSql('CREATE INDEX IDX_7A11D43AC54C8C93 ON type_place (type_id)');
        $this->addSql('CREATE INDEX IDX_7A11D43ADA6A219 ON type_place (place_id)');
        $this->addSql('ALTER TABLE type_place ADD CONSTRAINT FK_7A11D43AC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_place ADD CONSTRAINT FK_7A11D43ADA6A219 FOREIGN KEY (place_id) REFERENCES place (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE type_place DROP CONSTRAINT FK_7A11D43ADA6A219');
        $this->addSql('ALTER TABLE type_place DROP CONSTRAINT FK_7A11D43AC54C8C93');
        $this->addSql('DROP SEQUENCE place_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_id_seq CASCADE');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE type_place');
    }
}
