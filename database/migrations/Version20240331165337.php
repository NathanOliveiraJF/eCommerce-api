<?php

declare(strict_types=1);

namespace database\migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240331165337 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, sku VARCHAR(255) UNIQUE NOT NULL, name VARCHAR(255) NOT NULL, price INT, description VARCHAR(255), quantity INT, created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, code VARCHAR(255) NOT NULL UNIQUE , name VARCHAR(255) NOT NULL, created_at TIMESTAMP DEFAULT  CURRENT_TIMESTAMP, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)');
        $this->addSql('CREATE TABLE products_categories (id INT AUTO_INCREMENT PRIMARY KEY NOT NULL, product_id INT NOT NULL, category_id INT NOT NULL, FOREIGN KEY (product_id) references products(id) ON DELETE CASCADE, FOREIGN KEY (category_id) references categories(id), updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('products');
        $schema->dropTable('categories');
        $schema->dropTable('products_categories');
    }
}
