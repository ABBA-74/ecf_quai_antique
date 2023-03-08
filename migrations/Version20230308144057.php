<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230308144057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergy_product (allergy_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_A5D34059DBFD579D (allergy_id), INDEX IDX_A5D340594584665A (product_id), PRIMARY KEY(allergy_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu_formula_product (menu_formula_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_F087963584A7D754 (menu_formula_id), INDEX IDX_F08796354584665A (product_id), PRIMARY KEY(menu_formula_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_allergy (reservation_id INT NOT NULL, allergy_id INT NOT NULL, INDEX IDX_AC24F930B83297E7 (reservation_id), INDEX IDX_AC24F930DBFD579D (allergy_id), PRIMARY KEY(reservation_id, allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_table (reservation_id INT NOT NULL, table_id INT NOT NULL, INDEX IDX_B5565FE1B83297E7 (reservation_id), INDEX IDX_B5565FE1ECFF285C (table_id), PRIMARY KEY(reservation_id, table_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_allergy (user_id INT NOT NULL, allergy_id INT NOT NULL, INDEX IDX_93BC5CBFA76ED395 (user_id), INDEX IDX_93BC5CBFDBFD579D (allergy_id), PRIMARY KEY(user_id, allergy_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE allergy_product ADD CONSTRAINT FK_A5D34059DBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergy_product ADD CONSTRAINT FK_A5D340594584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_formula_product ADD CONSTRAINT FK_F087963584A7D754 FOREIGN KEY (menu_formula_id) REFERENCES menu_formula (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_formula_product ADD CONSTRAINT FK_F08796354584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_allergy ADD CONSTRAINT FK_AC24F930B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_allergy ADD CONSTRAINT FK_AC24F930DBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_table ADD CONSTRAINT FK_B5565FE1B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation_table ADD CONSTRAINT FK_B5565FE1ECFF285C FOREIGN KEY (table_id) REFERENCES `table` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergy ADD CONSTRAINT FK_93BC5CBFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_allergy ADD CONSTRAINT FK_93BC5CBFDBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE business_hours ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE business_hours ADD CONSTRAINT FK_F4FB5A32B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_F4FB5A32B1E7706E ON business_hours (restaurant_id)');
        $this->addSql('ALTER TABLE image ADD product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F4584665A ON image (product_id)');
        $this->addSql('ALTER TABLE product ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD12469DE2 ON product (category_id)');
        $this->addSql('ALTER TABLE reservation ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('ALTER TABLE room ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_729F519BB1E7706E ON room (restaurant_id)');
        $this->addSql('ALTER TABLE `table` ADD room_id INT NOT NULL');
        $this->addSql('ALTER TABLE `table` ADD CONSTRAINT FK_F6298F4654177093 FOREIGN KEY (room_id) REFERENCES room (id)');
        $this->addSql('CREATE INDEX IDX_F6298F4654177093 ON `table` (room_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergy_product DROP FOREIGN KEY FK_A5D34059DBFD579D');
        $this->addSql('ALTER TABLE allergy_product DROP FOREIGN KEY FK_A5D340594584665A');
        $this->addSql('ALTER TABLE menu_formula_product DROP FOREIGN KEY FK_F087963584A7D754');
        $this->addSql('ALTER TABLE menu_formula_product DROP FOREIGN KEY FK_F08796354584665A');
        $this->addSql('ALTER TABLE reservation_allergy DROP FOREIGN KEY FK_AC24F930B83297E7');
        $this->addSql('ALTER TABLE reservation_allergy DROP FOREIGN KEY FK_AC24F930DBFD579D');
        $this->addSql('ALTER TABLE reservation_table DROP FOREIGN KEY FK_B5565FE1B83297E7');
        $this->addSql('ALTER TABLE reservation_table DROP FOREIGN KEY FK_B5565FE1ECFF285C');
        $this->addSql('ALTER TABLE user_allergy DROP FOREIGN KEY FK_93BC5CBFA76ED395');
        $this->addSql('ALTER TABLE user_allergy DROP FOREIGN KEY FK_93BC5CBFDBFD579D');
        $this->addSql('DROP TABLE allergy_product');
        $this->addSql('DROP TABLE menu_formula_product');
        $this->addSql('DROP TABLE reservation_allergy');
        $this->addSql('DROP TABLE reservation_table');
        $this->addSql('DROP TABLE user_allergy');
        $this->addSql('ALTER TABLE business_hours DROP FOREIGN KEY FK_F4FB5A32B1E7706E');
        $this->addSql('DROP INDEX IDX_F4FB5A32B1E7706E ON business_hours');
        $this->addSql('ALTER TABLE business_hours DROP restaurant_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('DROP INDEX IDX_C53D045F4584665A ON image');
        $this->addSql('ALTER TABLE image DROP product_id');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('DROP INDEX IDX_D34A04AD12469DE2 ON product');
        $this->addSql('ALTER TABLE product DROP category_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP user_id');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BB1E7706E');
        $this->addSql('DROP INDEX IDX_729F519BB1E7706E ON room');
        $this->addSql('ALTER TABLE room DROP restaurant_id');
        $this->addSql('ALTER TABLE `table` DROP FOREIGN KEY FK_F6298F4654177093');
        $this->addSql('DROP INDEX IDX_F6298F4654177093 ON `table`');
        $this->addSql('ALTER TABLE `table` DROP room_id');
    }
}
