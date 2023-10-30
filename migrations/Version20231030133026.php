<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231030133026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE plot_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE plot (id INT NOT NULL, plot_id VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, attrs_plot_id VARCHAR(255) NOT NULL, attrs_plot_area INT NOT NULL, attrs_plot_price DOUBLE PRECISION NOT NULL, attrs_plot_number VARCHAR(255) NOT NULL, attrs_plot_address VARCHAR(255) NOT NULL, attrs_category_code VARCHAR(255) NOT NULL, attrs_category_name VARCHAR(255) NOT NULL, attrs_plot_area_inaccuracy INT NOT NULL, attrs_permitted_use_document_name VARCHAR(255) NOT NULL, attrs_permitted_use_classifier_code VARCHAR(255) DEFAULT NULL, attrs_permitted_use_classifier_name VARCHAR(255) DEFAULT NULL, extent_srs VARCHAR(255) NOT NULL, extent_xmax DOUBLE PRECISION NOT NULL, extent_xmin DOUBLE PRECISION NOT NULL, extent_ymax DOUBLE PRECISION NOT NULL, extent_ymin DOUBLE PRECISION NOT NULL, extent_width DOUBLE PRECISION NOT NULL, extent_height DOUBLE PRECISION NOT NULL, center_type VARCHAR(255) NOT NULL, center_spatial_geometry_type VARCHAR(255) NOT NULL, center_spatial_geometry_coordinates TEXT NOT NULL, center_spatial_crs_type VARCHAR(255) NOT NULL, center_spatial_crs_name VARCHAR(255) NOT NULL, spatial_type VARCHAR(255) NOT NULL, spatial_spatial_geometry_type VARCHAR(255) NOT NULL, spatial_spatial_geometry_coordinates TEXT NOT NULL, spatial_spatial_crs_type VARCHAR(255) NOT NULL, spatial_spatial_crs_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN plot.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN plot.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN plot.center_spatial_geometry_coordinates IS \'(DC2Type:simple_array)\'');
        $this->addSql('COMMENT ON COLUMN plot.spatial_spatial_geometry_coordinates IS \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE plot_id_seq CASCADE');
        $this->addSql('DROP TABLE plot');
    }
}
