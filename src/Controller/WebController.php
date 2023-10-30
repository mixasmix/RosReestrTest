<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Facade\PlotFacade;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class WebController extends AbstractController
{
    public function __construct(
        private readonly PlotFacade $plotFacade
    ) {
    }

    /**
     * @throws GuzzleException
     */
    #[Route(path: '/')]
    public function __invoke(Request $request): Response
    {
        $plotIds = $request->get('plot_ids');

        if (!empty($plotIds)) {
            $plotIds = array_map(
                fn (string $id): string => trim($id),
                explode(',', $plotIds)
            );
        }

        return $this->render(
            'base.html.twig',
            ['plots' => empty($plotIds) ? [] : $this->plotFacade->getPlots($plotIds)]
        );
    }
}
