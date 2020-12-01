<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201064911 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id CHAR(36) NOT NULL --(DC2Type:CategoryId)
        , name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF346685E237E06 ON categories (name)');
        $this->addSql('CREATE TABLE posts (id CHAR(36) NOT NULL --(DC2Type:PostId)
        , category_id CHAR(36) DEFAULT NULL --(DC2Type:CategoryId)
        , title VARCHAR(255) NOT NULL, content CLOB NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_885DBAFA2B36786B ON posts (title)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_885DBAFA989D9B62 ON posts (slug)');
        $this->addSql('CREATE INDEX IDX_885DBAFA12469DE2 ON posts (category_id)');
        $this->addSql('CREATE TABLE posts_tags (user_id CHAR(36) NOT NULL --(DC2Type:PostId)
        , tag_id CHAR(36) NOT NULL --(DC2Type:TagId)
        , PRIMARY KEY(user_id, tag_id))');
        $this->addSql('CREATE INDEX IDX_D5ECAD9FA76ED395 ON posts_tags (user_id)');
        $this->addSql('CREATE INDEX IDX_D5ECAD9FBAD26311 ON posts_tags (tag_id)');
        $this->addSql('CREATE TABLE tags (id CHAR(36) NOT NULL --(DC2Type:TagId)
        , name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6FBC94265E237E06 ON tags (name)');
        $this->addSql('CREATE TABLE tag_post (tag_id CHAR(36) NOT NULL --(DC2Type:TagId)
        , post_id CHAR(36) NOT NULL --(DC2Type:PostId)
        , PRIMARY KEY(tag_id, post_id))');
        $this->addSql('CREATE INDEX IDX_B485D33BBAD26311 ON tag_post (tag_id)');
        $this->addSql('CREATE INDEX IDX_B485D33B4B89032C ON tag_post (post_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE posts_tags');
        $this->addSql('DROP TABLE tags');
        $this->addSql('DROP TABLE tag_post');
    }
}
