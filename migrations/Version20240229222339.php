<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229222339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_plan DROP FOREIGN KEY FK_D2C01C3ED3728193');
        $this->addSql('DROP INDEX IDX_D2C01C3ED3728193 ON training_plan');
        $this->addSql('ALTER TABLE training_plan CHANGE person_id_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training_plan ADD CONSTRAINT FK_D2C01C3E9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D2C01C3E9D86650F ON training_plan (user_id_id)');
        $this->addSql('ALTER TABLE user ADD name VARCHAR(255) NOT NULL, ADD height VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE weight_history DROP FOREIGN KEY FK_D87E442FD3728193');
        $this->addSql('DROP INDEX IDX_D87E442FD3728193 ON weight_history');
        $this->addSql('ALTER TABLE weight_history CHANGE person_id_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE weight_history ADD CONSTRAINT FK_D87E442F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D87E442F9D86650F ON weight_history (user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE weight_history DROP FOREIGN KEY FK_D87E442F9D86650F');
        $this->addSql('DROP INDEX IDX_D87E442F9D86650F ON weight_history');
        $this->addSql('ALTER TABLE weight_history CHANGE user_id_id person_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE weight_history ADD CONSTRAINT FK_D87E442FD3728193 FOREIGN KEY (person_id_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D87E442FD3728193 ON weight_history (person_id_id)');
        $this->addSql('ALTER TABLE user DROP name, DROP height');
        $this->addSql('ALTER TABLE training_plan DROP FOREIGN KEY FK_D2C01C3E9D86650F');
        $this->addSql('DROP INDEX IDX_D2C01C3E9D86650F ON training_plan');
        $this->addSql('ALTER TABLE training_plan CHANGE user_id_id person_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE training_plan ADD CONSTRAINT FK_D2C01C3ED3728193 FOREIGN KEY (person_id_id) REFERENCES person (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D2C01C3ED3728193 ON training_plan (person_id_id)');
    }
}
