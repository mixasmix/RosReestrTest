<?php

declare(strict_types = 1);

namespace App\DTO;

use App\VO\Attrs;
use App\VO\Coordinates;
use App\VO\Extent;

readonly class PlotData
{
    public function __construct(
        public string $id,
        public string $number,
        public Attrs $attrs,
        public Extent $extent,
        public Coordinates $center,
        public Coordinates $spatial,
    ) {
    }
}
