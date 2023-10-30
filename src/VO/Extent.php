<?php

declare(strict_types = 1);

namespace App\VO;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Extent
{
    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $srs;

    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    private float $xmax;

    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    private float $xmin;

    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    private float $ymax;

    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    private float $ymin;

    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    private float $width;

    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    private float $height;

    /**
     * @param string $srs
     * @param float  $xmax
     * @param float  $xmin
     * @param float  $ymax
     * @param float  $ymin
     * @param float  $width
     * @param float  $height
     */
    public function __construct(
        string $srs,
        float $xmax,
        float $xmin,
        float $ymax,
        float $ymin,
        float $width,
        float $height
    ) {
        $this->srs = $srs;
        $this->xmax = $xmax;
        $this->xmin = $xmin;
        $this->ymax = $ymax;
        $this->ymin = $ymin;
        $this->width = $width;
        $this->height = $height;
    }

    public function getSrs(): string
    {
        return $this->srs;
    }

    public function getXmax(): float
    {
        return $this->xmax;
    }

    public function getXmin(): float
    {
        return $this->xmin;
    }

    public function getYmax(): float
    {
        return $this->ymax;
    }

    public function getYmin(): float
    {
        return $this->ymin;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }
}
