<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231006142453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agreement (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, is_active TINYINT(1) NOT NULL, created DATETIME DEFAULT NULL, INDEX IDX_2E655A24CB944F1A (student_id), INDEX IDX_2E655A24F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, author_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, crebo_code VARCHAR(255) DEFAULT NULL, cohort VARCHAR(255) DEFAULT NULL, version_kd VARCHAR(255) DEFAULT NULL, first_determiner VARCHAR(255) DEFAULT NULL, second_determiner VARCHAR(255) DEFAULT NULL, version VARCHAR(255) DEFAULT NULL, INDEX IDX_D7098951AE80F5DF (department_id), INDEX IDX_D7098951F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_board (id INT AUTO_INCREMENT NOT NULL, challenge_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, body LONGTEXT DEFAULT NULL, type INT NOT NULL, INDEX IDX_5C84A25598A21AC6 (challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_board_attachment (id INT AUTO_INCREMENT NOT NULL, board_id INT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, real_name VARCHAR(255) NOT NULL, size INT NOT NULL, mime_type VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, created DATETIME NOT NULL, INDEX IDX_87603583E7EC5785 (board_id), INDEX IDX_87603583B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_group (id INT AUTO_INCREMENT NOT NULL, challenge_id INT NOT NULL, name VARCHAR(255) NOT NULL, progress DOUBLE PRECISION NOT NULL, created DATETIME DEFAULT NULL, INDEX IDX_6912CDD798A21AC6 (challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE challenge_race (id INT AUTO_INCREMENT NOT NULL, challenge_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created DATETIME DEFAULT NULL, INDEX IDX_D3C0BC2998A21AC6 (challenge_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE checkup_moment (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, start DATETIME DEFAULT NULL, end DATETIME DEFAULT NULL, code VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, presence DOUBLE PRECISION DEFAULT NULL, is_final_of_day TINYINT(1) NOT NULL, created DATETIME DEFAULT NULL, INDEX IDX_628069F5B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dcmoment (id INT AUTO_INCREMENT NOT NULL, coach_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, comments LONGTEXT NOT NULL, enddate TIME DEFAULT NULL, created DATETIME DEFAULT NULL, INDEX IDX_F930E513C105691 (coach_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dcmoment_student (dcmoment_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_137A3577FCBA6EC8 (dcmoment_id), INDEX IDX_137A3577CB944F1A (student_id), PRIMARY KEY(dcmoment_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dcmoment_dctool (dcmoment_id INT NOT NULL, dctool_id INT NOT NULL, INDEX IDX_75DC29D9FCBA6EC8 (dcmoment_id), INDEX IDX_75DC29D9ABF59EEC (dctool_id), PRIMARY KEY(dcmoment_id, dctool_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dctool (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, school_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_CD1DE18AC32A47EE (school_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_template (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, is_global_available TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_template_student_group (group_template_id INT NOT NULL, student_group_id INT NOT NULL, INDEX IDX_A146B1D20621079 (group_template_id), INDEX IDX_A146B1D4DDF95DC (student_group_id), PRIMARY KEY(group_template_id, student_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login_try (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, created DATETIME NOT NULL, ip_address VARCHAR(255) NOT NULL, user_agent VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permission (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progress_moment (id INT AUTO_INCREMENT NOT NULL, coach_id INT NOT NULL, student_id INT DEFAULT NULL, created DATETIME NOT NULL, coach_message LONGTEXT NOT NULL, student_message LONGTEXT DEFAULT NULL, rating INT NOT NULL, INDEX IDX_8465D9753C105691 (coach_id), INDEX IDX_8465D975CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE school (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, student_group_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, student_number INT NOT NULL, is_new TINYINT(1) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, access_token VARCHAR(255) DEFAULT NULL, last_login DATETIME DEFAULT NULL, default_checkup_moment_status VARCHAR(255) NOT NULL, uuid_v4 BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', created DATETIME DEFAULT NULL, INDEX IDX_B723AF334DDF95DC (student_group_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_checkup_moment (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, checkup_moment_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, updated DATETIME DEFAULT NULL, unique_id VARCHAR(255) DEFAULT NULL, ip_address VARCHAR(255) DEFAULT NULL, medium VARCHAR(255) DEFAULT NULL, lon VARCHAR(255) DEFAULT NULL, lat VARCHAR(255) DEFAULT NULL, ssid VARCHAR(255) DEFAULT NULL, is_suspicious TINYINT(1) NOT NULL, rating INT DEFAULT NULL, created DATETIME DEFAULT NULL, INDEX IDX_75624B4ECB944F1A (student_id), INDEX IDX_75624B4E8CC927A7 (checkup_moment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_group (id INT AUTO_INCREMENT NOT NULL, department_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, cohort VARCHAR(255) NOT NULL, INDEX IDX_E5F73D58AE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_group_teacher (student_group_id INT NOT NULL, teacher_id INT NOT NULL, INDEX IDX_636A0A474DDF95DC (student_group_id), INDEX IDX_636A0A4741807E1D (teacher_id), PRIMARY KEY(student_group_id, teacher_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_reset_token (id INT AUTO_INCREMENT NOT NULL, student_id INT NOT NULL, token VARCHAR(255) NOT NULL, expires DATETIME NOT NULL, is_used TINYINT(1) NOT NULL, created DATETIME DEFAULT NULL, INDEX IDX_28D11ACB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher (id INT AUTO_INCREMENT NOT NULL, lettercode VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, access_token VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, created DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teacher_user_role (teacher_id INT NOT NULL, user_role_id INT NOT NULL, INDEX IDX_57838AB841807E1D (teacher_id), INDEX IDX_57838AB88E0E3CA6 (user_role_id), PRIMARY KEY(teacher_id, user_role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_access_token (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, created DATETIME NOT NULL, token VARCHAR(255) NOT NULL, expires DATETIME NOT NULL, has_expired TINYINT(1) NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_366EA16AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role_permission (user_role_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_7DA194098E0E3CA6 (user_role_id), INDEX IDX_7DA19409FED90CCA (permission_id), PRIMARY KEY(user_role_id, permission_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT FK_2E655A24CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE agreement ADD CONSTRAINT FK_2E655A24F675F31B FOREIGN KEY (author_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE challenge ADD CONSTRAINT FK_D7098951F675F31B FOREIGN KEY (author_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE challenge_board ADD CONSTRAINT FK_5C84A25598A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id)');
        $this->addSql('ALTER TABLE challenge_board_attachment ADD CONSTRAINT FK_87603583E7EC5785 FOREIGN KEY (board_id) REFERENCES challenge_board (id)');
        $this->addSql('ALTER TABLE challenge_board_attachment ADD CONSTRAINT FK_87603583B03A8386 FOREIGN KEY (created_by_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE challenge_group ADD CONSTRAINT FK_6912CDD798A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge_race (id)');
        $this->addSql('ALTER TABLE challenge_race ADD CONSTRAINT FK_D3C0BC2998A21AC6 FOREIGN KEY (challenge_id) REFERENCES challenge (id)');
        $this->addSql('ALTER TABLE checkup_moment ADD CONSTRAINT FK_628069F5B03A8386 FOREIGN KEY (created_by_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE dcmoment ADD CONSTRAINT FK_F930E513C105691 FOREIGN KEY (coach_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE dcmoment_student ADD CONSTRAINT FK_137A3577FCBA6EC8 FOREIGN KEY (dcmoment_id) REFERENCES dcmoment (id)');
        $this->addSql('ALTER TABLE dcmoment_student ADD CONSTRAINT FK_137A3577CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dcmoment_dctool ADD CONSTRAINT FK_75DC29D9FCBA6EC8 FOREIGN KEY (dcmoment_id) REFERENCES dcmoment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dcmoment_dctool ADD CONSTRAINT FK_75DC29D9ABF59EEC FOREIGN KEY (dctool_id) REFERENCES dctool (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE department ADD CONSTRAINT FK_CD1DE18AC32A47EE FOREIGN KEY (school_id) REFERENCES school (id)');
        $this->addSql('ALTER TABLE group_template_student_group ADD CONSTRAINT FK_A146B1D20621079 FOREIGN KEY (group_template_id) REFERENCES group_template (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_template_student_group ADD CONSTRAINT FK_A146B1D4DDF95DC FOREIGN KEY (student_group_id) REFERENCES student_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE progress_moment ADD CONSTRAINT FK_8465D9753C105691 FOREIGN KEY (coach_id) REFERENCES teacher (id)');
        $this->addSql('ALTER TABLE progress_moment ADD CONSTRAINT FK_8465D975CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF334DDF95DC FOREIGN KEY (student_group_id) REFERENCES student_group (id)');
        $this->addSql('ALTER TABLE student_checkup_moment ADD CONSTRAINT FK_75624B4ECB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE student_checkup_moment ADD CONSTRAINT FK_75624B4E8CC927A7 FOREIGN KEY (checkup_moment_id) REFERENCES checkup_moment (id)');
        $this->addSql('ALTER TABLE student_group ADD CONSTRAINT FK_E5F73D58AE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
        $this->addSql('ALTER TABLE student_group_teacher ADD CONSTRAINT FK_636A0A474DDF95DC FOREIGN KEY (student_group_id) REFERENCES student_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_group_teacher ADD CONSTRAINT FK_636A0A4741807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_reset_token ADD CONSTRAINT FK_28D11ACB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE teacher_user_role ADD CONSTRAINT FK_57838AB841807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE teacher_user_role ADD CONSTRAINT FK_57838AB88E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES user_role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_access_token ADD CONSTRAINT FK_366EA16AA76ED395 FOREIGN KEY (user_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE user_role_permission ADD CONSTRAINT FK_7DA194098E0E3CA6 FOREIGN KEY (user_role_id) REFERENCES user_role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role_permission ADD CONSTRAINT FK_7DA19409FED90CCA FOREIGN KEY (permission_id) REFERENCES permission (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agreement DROP FOREIGN KEY FK_2E655A24CB944F1A');
        $this->addSql('ALTER TABLE agreement DROP FOREIGN KEY FK_2E655A24F675F31B');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951AE80F5DF');
        $this->addSql('ALTER TABLE challenge DROP FOREIGN KEY FK_D7098951F675F31B');
        $this->addSql('ALTER TABLE challenge_board DROP FOREIGN KEY FK_5C84A25598A21AC6');
        $this->addSql('ALTER TABLE challenge_board_attachment DROP FOREIGN KEY FK_87603583E7EC5785');
        $this->addSql('ALTER TABLE challenge_board_attachment DROP FOREIGN KEY FK_87603583B03A8386');
        $this->addSql('ALTER TABLE challenge_group DROP FOREIGN KEY FK_6912CDD798A21AC6');
        $this->addSql('ALTER TABLE challenge_race DROP FOREIGN KEY FK_D3C0BC2998A21AC6');
        $this->addSql('ALTER TABLE checkup_moment DROP FOREIGN KEY FK_628069F5B03A8386');
        $this->addSql('ALTER TABLE dcmoment DROP FOREIGN KEY FK_F930E513C105691');
        $this->addSql('ALTER TABLE dcmoment_student DROP FOREIGN KEY FK_137A3577FCBA6EC8');
        $this->addSql('ALTER TABLE dcmoment_student DROP FOREIGN KEY FK_137A3577CB944F1A');
        $this->addSql('ALTER TABLE dcmoment_dctool DROP FOREIGN KEY FK_75DC29D9FCBA6EC8');
        $this->addSql('ALTER TABLE dcmoment_dctool DROP FOREIGN KEY FK_75DC29D9ABF59EEC');
        $this->addSql('ALTER TABLE department DROP FOREIGN KEY FK_CD1DE18AC32A47EE');
        $this->addSql('ALTER TABLE group_template_student_group DROP FOREIGN KEY FK_A146B1D20621079');
        $this->addSql('ALTER TABLE group_template_student_group DROP FOREIGN KEY FK_A146B1D4DDF95DC');
        $this->addSql('ALTER TABLE progress_moment DROP FOREIGN KEY FK_8465D9753C105691');
        $this->addSql('ALTER TABLE progress_moment DROP FOREIGN KEY FK_8465D975CB944F1A');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF334DDF95DC');
        $this->addSql('ALTER TABLE student_checkup_moment DROP FOREIGN KEY FK_75624B4ECB944F1A');
        $this->addSql('ALTER TABLE student_checkup_moment DROP FOREIGN KEY FK_75624B4E8CC927A7');
        $this->addSql('ALTER TABLE student_group DROP FOREIGN KEY FK_E5F73D58AE80F5DF');
        $this->addSql('ALTER TABLE student_group_teacher DROP FOREIGN KEY FK_636A0A474DDF95DC');
        $this->addSql('ALTER TABLE student_group_teacher DROP FOREIGN KEY FK_636A0A4741807E1D');
        $this->addSql('ALTER TABLE student_reset_token DROP FOREIGN KEY FK_28D11ACB944F1A');
        $this->addSql('ALTER TABLE teacher_user_role DROP FOREIGN KEY FK_57838AB841807E1D');
        $this->addSql('ALTER TABLE teacher_user_role DROP FOREIGN KEY FK_57838AB88E0E3CA6');
        $this->addSql('ALTER TABLE user_access_token DROP FOREIGN KEY FK_366EA16AA76ED395');
        $this->addSql('ALTER TABLE user_role_permission DROP FOREIGN KEY FK_7DA194098E0E3CA6');
        $this->addSql('ALTER TABLE user_role_permission DROP FOREIGN KEY FK_7DA19409FED90CCA');
        $this->addSql('DROP TABLE agreement');
        $this->addSql('DROP TABLE challenge');
        $this->addSql('DROP TABLE challenge_board');
        $this->addSql('DROP TABLE challenge_board_attachment');
        $this->addSql('DROP TABLE challenge_group');
        $this->addSql('DROP TABLE challenge_race');
        $this->addSql('DROP TABLE checkup_moment');
        $this->addSql('DROP TABLE dcmoment');
        $this->addSql('DROP TABLE dcmoment_student');
        $this->addSql('DROP TABLE dcmoment_dctool');
        $this->addSql('DROP TABLE dctool');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE group_template');
        $this->addSql('DROP TABLE group_template_student_group');
        $this->addSql('DROP TABLE login_try');
        $this->addSql('DROP TABLE permission');
        $this->addSql('DROP TABLE progress_moment');
        $this->addSql('DROP TABLE school');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_checkup_moment');
        $this->addSql('DROP TABLE student_group');
        $this->addSql('DROP TABLE student_group_teacher');
        $this->addSql('DROP TABLE student_reset_token');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE teacher_user_role');
        $this->addSql('DROP TABLE user_access_token');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE user_role_permission');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
