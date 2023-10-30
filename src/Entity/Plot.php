<?php

namespace App\Entity;

use App\Repository\PlotRepository;
use App\VO\Attrs;
use App\VO\Center;
use App\VO\Coordinates;
use App\VO\Extent;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlotRepository::class)]
class Plot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $plotId;

    #[ORM\Column(length: 255)]
    private string $number;

    #[ORM\Embedded(columnPrefix: 'attrs_')]
    private Attrs $attrs;

    #[ORM\Embedded(columnPrefix: 'extent_')]
    private Extent $extent;

    #[ORM\Embedded(columnPrefix: 'center_')]
    private Coordinates $center;

    #[ORM\Embedded(columnPrefix: 'spatial_')]
    private Coordinates $spatial;

    #[ORM\Column]
    private DateTimeImmutable $createdAt;

    #[ORM\Column]
    private DateTimeImmutable $updatedAt;

    /**
     * @param string                 $plotId
     * @param string                 $number
     * @param Attrs                  $attrs
     * @param Extent                 $extent
     * @param Coordinates            $center
     * @param Coordinates            $spatial
     * @param DateTimeImmutable|null $createdAt
     * @param DateTimeImmutable|null $updatedAt
     */
    public function __construct(
        string $plotId,
        string $number,
        Attrs $attrs,
        Extent $extent,
        Coordinates $center,
        Coordinates $spatial,
        ?DateTimeImmutable $createdAt = null,
        ?DateTimeImmutable $updatedAt = null,
    ) {
        $this->plotId = $plotId;
        $this->number = $number;
        $this->attrs = $attrs;
        $this->extent = $extent;
        $this->center = $center;
        $this->spatial = $spatial;
        $this->createdAt = $createdAt ?? new DateTimeImmutable();
        $this->updatedAt = $updatedAt ?? new DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlotId(): string
    {
        return $this->plotId;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getAttrs(): Attrs
    {
        return $this->attrs;
    }

    public function getExtent(): Extent
    {
        return $this->extent;
    }

    public function getCenter(): Coordinates
    {
        return $this->center;
    }

    public function getSpatial(): Coordinates
    {
        return $this->spatial;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
