<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203122726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE orbitale_cms_categories_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE orbitale_cms_pages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE orbitale_cms_categories (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8EF7232989D9B62 ON orbitale_cms_categories (slug)');
        $this->addSql('CREATE INDEX IDX_A8EF7232727ACA70 ON orbitale_cms_categories (parent_id)');
        $this->addSql('CREATE TABLE orbitale_cms_pages (id INT NOT NULL, category_id INT DEFAULT NULL, parent_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, page_content TEXT DEFAULT NULL, meta_description VARCHAR(255) DEFAULT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_keywords VARCHAR(255) DEFAULT NULL, css TEXT DEFAULT NULL, js TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, enabled BOOLEAN NOT NULL, homepage BOOLEAN NOT NULL, host VARCHAR(255) DEFAULT NULL, locale VARCHAR(6) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C0E694ED989D9B62 ON orbitale_cms_pages (slug)');
        $this->addSql('CREATE INDEX IDX_C0E694ED12469DE2 ON orbitale_cms_pages (category_id)');
        $this->addSql('CREATE INDEX IDX_C0E694ED727ACA70 ON orbitale_cms_pages (parent_id)');
        $this->addSql('COMMENT ON COLUMN orbitale_cms_pages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE orbitale_cms_categories ADD CONSTRAINT FK_A8EF7232727ACA70 FOREIGN KEY (parent_id) REFERENCES orbitale_cms_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orbitale_cms_pages ADD CONSTRAINT FK_C0E694ED12469DE2 FOREIGN KEY (category_id) REFERENCES orbitale_cms_categories (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE orbitale_cms_pages ADD CONSTRAINT FK_C0E694ED727ACA70 FOREIGN KEY (parent_id) REFERENCES orbitale_cms_pages (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE orbitale_cms_categories_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE orbitale_cms_pages_id_seq CASCADE');
        $this->addSql('ALTER TABLE orbitale_cms_categories DROP CONSTRAINT FK_A8EF7232727ACA70');
        $this->addSql('ALTER TABLE orbitale_cms_pages DROP CONSTRAINT FK_C0E694ED12469DE2');
        $this->addSql('ALTER TABLE orbitale_cms_pages DROP CONSTRAINT FK_C0E694ED727ACA70');
        $this->addSql('DROP TABLE orbitale_cms_categories');
        $this->addSql('DROP TABLE orbitale_cms_pages');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
