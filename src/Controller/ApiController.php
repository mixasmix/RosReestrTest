<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Facade\PlotFacade;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
class ApiController
{
    public function __construct(
        private readonly PlotFacade $plotFacade,
        private readonly SerializerInterface $serializer,
    ) {
    }

    #[Route(path: '/plot', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $plotIds = $request->get('plot_ids');

        if (!is_array($plotIds)) {
            $plotIds = [$plotIds];
        }

        return new JsonResponse($this->serializer->serialize($this->plotFacade->getPlots($plotIds), 'json'), json: true);
    }
}
