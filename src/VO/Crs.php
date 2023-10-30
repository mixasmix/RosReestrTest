<?php

declare(strict_types = 1);

namespace App\VO;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Crs
{
    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $type;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $name;

    /**
     * @param string $type
     * @param string $value
     */
    public function __construct(string $type, string $value)
    {
        $this->type = $type;
        $this->name = $value;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
