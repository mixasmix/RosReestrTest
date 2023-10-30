<?php

declare(strict_types = 1);

namespace App\VO;

use App\Enum\GeometryType;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Geometry
{
    #[ORM\Column(type: Types::STRING, nullable: false, enumType: GeometryType::class)]
    private GeometryType $type;

    #[ORM\Column(type: Types::JSON)]
    private array $coordinates;

    /**
     * @param GeometryType $type
     * @param array        $coordinates
     */
    public function __construct(GeometryType $type, array $coordinates)
    {
        $this->type = $type;
        $this->coordinates = $coordinates;
    }

    public function getType(): GeometryType
    {
        return $this->type;
    }

    public function getCoordinates(): array
    {
        return $this->coordinates;
    }
}
