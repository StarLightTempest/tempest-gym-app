<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240215211258 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE machines (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, max_capacity INT NOT NULL, weight_increment INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, height VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_execution (id INT AUTO_INCREMENT NOT NULL, training_plan_x_machine_id_id INT DEFAULT NULL, date DATE NOT NULL, completed TINYINT(1) NOT NULL, INDEX IDX_6C2CB4CE9086AC30 (training_plan_x_machine_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_plan (id INT AUTO_INCREMENT NOT NULL, person_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D2C01C3ED3728193 (person_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training_plan_xmachine (id INT AUTO_INCREMENT NOT NULL, training_plan_id_id INT DEFAULT NULL, machine_id_id INT DEFAULT NULL, weight INT NOT NULL, intervals INT NOT NULL, repetitions INT NOT NULL, INDEX IDX_E2320D5D965C61CD (training_plan_id_id), INDEX IDX_E2320D5D56CB5D24 (machine_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE weight_history (id INT AUTO_INCREMENT NOT NULL, person_id_id INT DEFAULT NULL, date DATE NOT NULL, weight INT NOT NULL, INDEX IDX_D87E442FD3728193 (person_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE training_execution ADD CONSTRAINT FK_6C2CB4CE9086AC30 FOREIGN KEY (training_plan_x_machine_id_id) REFERENCES training_plan_xmachine (id)');
        $this->addSql('ALTER TABLE training_plan ADD CONSTRAINT FK_D2C01C3ED3728193 FOREIGN KEY (person_id_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE training_plan_xmachine ADD CONSTRAINT FK_E2320D5D965C61CD FOREIGN KEY (training_plan_id_id) REFERENCES training_plan (id)');
        $this->addSql('ALTER TABLE training_plan_xmachine ADD CONSTRAINT FK_E2320D5D56CB5D24 FOREIGN KEY (machine_id_id) REFERENCES machines (id)');
        $this->addSql('ALTER TABLE weight_history ADD CONSTRAINT FK_D87E442FD3728193 FOREIGN KEY (person_id_id) REFERENCES person (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE training_execution DROP FOREIGN KEY FK_6C2CB4CE9086AC30');
        $this->addSql('ALTER TABLE training_plan DROP FOREIGN KEY FK_D2C01C3ED3728193');
        $this->addSql('ALTER TABLE training_plan_xmachine DROP FOREIGN KEY FK_E2320D5D965C61CD');
        $this->addSql('ALTER TABLE training_plan_xmachine DROP FOREIGN KEY FK_E2320D5D56CB5D24');
        $this->addSql('ALTER TABLE weight_history DROP FOREIGN KEY FK_D87E442FD3728193');
        $this->addSql('DROP TABLE machines');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE training_execution');
        $this->addSql('DROP TABLE training_plan');
        $this->addSql('DROP TABLE training_plan_xmachine');
        $this->addSql('DROP TABLE weight_history');
    }
}
