<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251210003704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, genre VARCHAR(128) NOT NULL)');
        $this->addSql('CREATE TABLE item (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(128) NOT NULL, year INTEGER NOT NULL, director VARCHAR(128) NOT NULL, actors CLOB NOT NULL, type INTEGER NOT NULL, duration INTEGER DEFAULT NULL, season INTEGER DEFAULT NULL, cover_url VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE item_streaming (item_id INTEGER NOT NULL, streaming_id INTEGER NOT NULL, PRIMARY KEY (item_id, streaming_id), CONSTRAINT FK_2A990E91126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2A990E91429AEC72 FOREIGN KEY (streaming_id) REFERENCES streaming (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2A990E91126F525E ON item_streaming (item_id)');
        $this->addSql('CREATE INDEX IDX_2A990E91429AEC72 ON item_streaming (streaming_id)');
        $this->addSql('CREATE TABLE item_tag (item_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY (item_id, tag_id), CONSTRAINT FK_E49CCCB1126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E49CCCB1BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E49CCCB1126F525E ON item_tag (item_id)');
        $this->addSql('CREATE INDEX IDX_E49CCCB1BAD26311 ON item_tag (tag_id)');
        $this->addSql('CREATE TABLE item_category (item_id INTEGER NOT NULL, category_id INTEGER NOT NULL, PRIMARY KEY (item_id, category_id), CONSTRAINT FK_6A41D10A126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6A41D10A12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6A41D10A126F525E ON item_category (item_id)');
        $this->addSql('CREATE INDEX IDX_6A41D10A12469DE2 ON item_category (category_id)');
        $this->addSql('CREATE TABLE item_rating (item_id INTEGER NOT NULL, rating_id INTEGER NOT NULL, PRIMARY KEY (item_id, rating_id), CONSTRAINT FK_5E7053ED126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5E7053EDA32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5E7053ED126F525E ON item_rating (item_id)');
        $this->addSql('CREATE INDEX IDX_5E7053EDA32EFC6 ON item_rating (rating_id)');
        $this->addSql('CREATE TABLE rating (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, rating DOUBLE PRECISION NOT NULL, comment CLOB NOT NULL)');
        $this->addSql('CREATE TABLE streaming (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, platform_name VARCHAR(128) NOT NULL)');
        $this->addSql('CREATE TABLE tag (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tag_name VARCHAR(128) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE item_streaming');
        $this->addSql('DROP TABLE item_tag');
        $this->addSql('DROP TABLE item_category');
        $this->addSql('DROP TABLE item_rating');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE streaming');
        $this->addSql('DROP TABLE tag');
    }
}
