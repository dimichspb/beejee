<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180926115049 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $statement =
<<<SQL
CREATE TABLE task (
  id VARCHAR(36) NOT NULL, 
  user VARCHAR(32) NOT NULL, 
  email varchar(64) NOT NULL,
  description VARCHAR(1024) NOT NULL,
  image VARCHAR(255) NOT NULL,
  done BOOL
);
SQL;

        $this->addSql($statement);
    }

    public function down(Schema $schema) : void
    {
        $statement =
<<<SQL
DROP TABLE IF EXISTS task;
SQL;
        $this->addSql($statement);
    }
}
