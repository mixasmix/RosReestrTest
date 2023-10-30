<?php

declare(strict_types = 1);

namespace App\VO;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Coordinates
{
    #[ORM\Column]
    private string $type;

    #[ORM\Embedded(columnPrefix: 'spatial_geometry_')]
    private Geometry $geometry;

    #[ORM\Embedded(columnPrefix: 'spatial_crs_')]
    private Crs $crs;

    /**
     * @param string   $type
     * @param Geometry $geometry
     * @param Crs      $crs
     */
    public function __construct(
        string $type,
        Geometry $geometry,
        Crs $crs,
    ) {
        $this->type = $type;
        $this->geometry = $geometry;
        $this->crs = $crs;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getGeometry(): Geometry
    {
        return $this->geometry;
    }

    public function getCrs(): Crs
    {
        return $this->crs;
    }
}
