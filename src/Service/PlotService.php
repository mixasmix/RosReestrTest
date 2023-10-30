<?php

declare(strict_types = 1);

namespace App\Service;

use App\Entity\Plot;
use App\Repository\PlotRepository;
use App\VO\Attrs;
use App\VO\Coordinates;
use App\VO\Extent;
use Exception;

class PlotService
{
    public function __construct(
        private readonly PlotRepository $plotRepository,
    ) {
    }

    /**
     * @throws Exception
     */
    public function createPlot(
        string $plotId,
        string $number,
        Attrs $attrs,
        Extent $extent,
        Coordinates $center,
        Coordinates $spatial,
    ): Plot {
        return $this->plotRepository->save(
            new Plot(
                plotId: $plotId,
                number: $number,
                attrs: $attrs,
                extent: $extent,
                center: $center,
                spatial: $spatial,
            ),
            true
        );
    }
}
