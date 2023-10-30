<?php

declare(strict_types = 1);

namespace App\Facade;

use App\DTO\PlotData;
use App\Entity\Plot;
use App\Repository\PlotRepository;
use App\Service\External\RosReestrApi;
use App\Service\PlotService;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class PlotFacade
{
    public function __construct(
        private readonly RosReestrApi $reestrApi,
        private readonly PlotService $plotService,
        private readonly PlotRepository $plotRepository,
    ) {
    }

    /**
     * @param array<string> $plotIds
     *
     * @return array<Plot>
     * @throws GuzzleException
     * @throws Exception
     */
    public function getPlots(array $plotIds): array
    {
        $plots = $this->plotRepository->getByIds($plotIds);

        if (!empty($plots)) {
            return $plots;
        }

        return array_map(
            fn (PlotData $data): Plot => $this->plotService->createPlot(
                plotId: $data->id,
                number: $data->number,
                attrs: $data->attrs,
                extent: $data->extent,
                center: $data->center,
                spatial: $data->spatial
            ),
            $this->reestrApi->getPlotsData($plotIds),
        );
    }
}
