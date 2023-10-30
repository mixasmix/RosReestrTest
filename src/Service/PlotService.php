<?php

declare(strict_types = 1);

namespace App\Service;

use App\Entity\Plot;
use App\VO\Attrs;
use App\VO\Coordinates;
use App\VO\Extent;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class PlotService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
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
        $this->entityManager->beginTransaction();

        try {
            $plot = new Plot(
                plotId: $plotId,
                number: $number,
                attrs: $attrs,
                extent: $extent,
                center: $center,
                spatial: $spatial,
            );

            $this->entityManager->persist($plot);

            $this->entityManager->flush();
        } catch (Exception $exception) {
            $this->entityManager->rollback();

            throw $exception;
        }

        $this->entityManager->commit();

        return $plot;
    }
}
