<?php

declare(strict_types = 1);

namespace App\Command;

use App\Entity\Plot;
use App\Facade\PlotFacade;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetPlotsCommand extends Command
{
    public function __construct(
        private readonly PlotFacade $plotFacade,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this->setName('plot:get')
            ->setDescription(
                'Получить значения',
            );

        $this->addArgument(
            name: 'plotsId',
            mode: InputArgument::IS_ARRAY,
            description: 'Идентификатор участка',
            default: [],
        );
    }

    /**
     * @throws GuzzleException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);

        $table->setHeaders(['Идентификатор', 'Адрес', 'Цена']);

        array_map(
            fn (Plot $plot): Table => $table->addRow(
                [
                    $plot->getPlotId(),
                    $plot->getAttrs()->getPlotAddress(),
                    $plot->getAttrs()->getPlotPrice(),
                ],
            ),
            $this->plotFacade->getPlots($input->getArgument('plotsId')),
        );

        $table->render();

        return Command::SUCCESS;
    }
}
