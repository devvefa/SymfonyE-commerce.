<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190819041930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(30) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, subject VARCHAR(255) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, status VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE title title VARCHAR(100) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE keywords keywords VARCHAR(255) DEFAULT NULL, CHANGE status status VARCHAR(10) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE product_id product_id INT DEFAULT NULL, CHANGE image image VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE product CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE type type VARCHAR(50) DEFAULT NULL, CHANGE publisher_id publisher_id INT DEFAULT NULL, CHANGE year year INT DEFAULT NULL, CHANGE amount amount INT DEFAULT NULL, CHANGE pprice pprice INT DEFAULT NULL, CHANGE sprice sprice INT DEFAULT NULL, CHANGE min min INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE keywords keywords VARCHAR(255) DEFAULT NULL, CHANGE detail detail VARCHAR(255) DEFAULT NULL, CHANGE image image VARCHAR(150) DEFAULT NULL, CHANGE writer writer INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE categor_id categor_id INT DEFAULT NULL, CHANGE status status VARCHAR(10) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE settning CHANGE title title VARCHAR(100) DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL, CHANGE keywords keywords VARCHAR(255) DEFAULT NULL, CHANGE company company VARCHAR(20) DEFAULT NULL, CHANGE adress adress VARCHAR(255) DEFAULT NULL, CHANGE fax fax INT DEFAULT NULL, CHANGE tele tele INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE facebook facebook VARCHAR(255) DEFAULT NULL, CHANGE twitter twitter VARCHAR(255) DEFAULT NULL, CHANGE instagram instagram VARCHAR(255) DEFAULT NULL, CHANGE linkedin linkedin VARCHAR(255) DEFAULT NULL, CHANGE smptserver smptserver VARCHAR(100) DEFAULT NULL, CHANGE smtpmail smtpmail VARCHAR(150) DEFAULT NULL, CHANGE smtpport smtpport VARCHAR(100) DEFAULT NULL, CHANGE aboutus aboutus VARCHAR(255) DEFAULT NULL, CHANGE contact contact VARCHAR(255) DEFAULT NULL, CHANGE referance referance VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_up updated_up VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(50) DEFAULT NULL, CHANGE email email VARCHAR(150) DEFAULT NULL, CHANGE password password VARCHAR(150) DEFAULT NULL, CHANGE type type VARCHAR(50) DEFAULT NULL, CHANGE status status VARCHAR(20) DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE kullanici CHANGE roles roles JSON NOT NULL, CHANGE name name VARCHAR(100) DEFAULT NULL, CHANGE status status VARCHAR(10) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE messages');
        $this->addSql('ALTER TABLE category CHANGE parent_id parent_id INT DEFAULT NULL, CHANGE title title VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE keywords keywords VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(10) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE image CHANGE product_id product_id INT DEFAULT NULL, CHANGE image image VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE kullanici CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin, CHANGE name name VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(10) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE product CHANGE title title VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE type type VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE publisher_id publisher_id INT DEFAULT NULL, CHANGE year year INT DEFAULT NULL, CHANGE amount amount INT DEFAULT NULL, CHANGE pprice pprice INT DEFAULT NULL, CHANGE sprice sprice INT DEFAULT NULL, CHANGE min min INT DEFAULT NULL, CHANGE description description VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE keywords keywords VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE detail detail VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE image image VARCHAR(150) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE writer writer INT DEFAULT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE categor_id categor_id INT DEFAULT NULL, CHANGE status status VARCHAR(10) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE settning CHANGE title title VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE description description VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE keywords keywords VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE company company VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE adress adress VARCHAR(255) DEFAULT \'\'\'\' COLLATE utf8mb4_unicode_ci, CHANGE fax fax INT DEFAULT NULL, CHANGE tele tele INT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE facebook facebook VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE twitter twitter VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE instagram instagram VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE linkedin linkedin VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE smptserver smptserver VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE smtpmail smtpmail VARCHAR(150) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE smtpport smtpport VARCHAR(100) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE aboutus aboutus VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE contact contact VARCHAR(255) DEFAULT \'\'\'\' COLLATE utf8mb4_unicode_ci, CHANGE referance referance VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_up updated_up VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE user CHANGE name name VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(150) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(150) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE type type VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT \'NULL\', CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
