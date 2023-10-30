<?php

declare(strict_types = 1);

namespace App\Service\External;

use App\DTO\PlotData;
use App\Enum\GeometryType;
use App\VO\Attrs;
use App\VO\Coordinates;
use App\VO\Crs;
use App\VO\Extent;
use App\VO\Geometry;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class RosReestrApi
{
    private const GET_PLOTS = '/test/plots';

    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.pkk.bigland.ru',
            'http_errors' => false,
        ]);;
    }

    /**
     * @param array<string> $plotIds
     *
     * @return array<PlotData>
     * @throws GuzzleException
     * @throws Exception
     */
    public function getPlotsData(array $plotIds): array
    {
        $response = $this->client->get(
            uri: self::GET_PLOTS,
            options: [
                'json' => [
                    'collection' => [
                        'plots' => $plotIds
                    ],
                ],
            ],
        );

        if ($response->getStatusCode() >= 400) {
            throw new Exception(message: $response->getBody()->getContents());
        }

        return array_map(
            fn (array $data): PlotData => new PlotData(
                id: $data['id'],
                number: $data['number'],
                attrs: new Attrs(
                    plotId: $data['attrs']['plot_id'],
                    plotArea: $data['attrs']['plot_area'],
                    plotPrice: $data['attrs']['plot_price'],
                    plotNumber: $data['attrs']['plot_number'],
                    plotAddress: $data['attrs']['plot_address'],
                    categoryCode: $data['attrs']['category_code'],
                    categoryName: $data['attrs']['category_name'],
                    plotAreaInaccuracy: $data['attrs']['plot_area_inaccuracy'],
                    permittedUseDocumentName: $data['attrs']['permitted_use_document_name'],
                    permittedUseClassifierCode: $data['attrs']['permitted_use_classifier_code'],
                    permittedUseClassifierName: $data['attrs']['permitted_use_classifier_name'],
                ),
                extent: new Extent(
                    srs: $data['extent']['srs'],
                    xmax:$data['extent']['xmax'],
                    xmin:$data['extent']['xmin'],
                    ymax:$data['extent']['ymax'],
                    ymin:$data['extent']['ymin'],
                    width:$data['extent']['width'],
                    height:$data['extent']['height'],
                ),
                center: new Coordinates(
                    type: $data['center']['type'],
                    geometry: new Geometry(
                        type: GeometryType::from($data['center']['geometry']['type']),
                        coordinates: $data['center']['geometry']['coordinates'],
                    ),
                    crs: new Crs(
                        type: $data['center']['crs']['type'],
                        value: current($data['center']['crs']['properties'])
                    ),
                ),
                spatial: new Coordinates(
                    type: $data['spatial']['type'],
                    geometry: new Geometry(
                        type: GeometryType::from($data['spatial']['geometry']['type']),
                        coordinates: $data['spatial']['geometry']['coordinates'],
                    ),
                    crs: new Crs(
                        type: $data['spatial']['crs']['type'],
                        value: current($data['spatial']['crs']['properties'])
                    ),
                ),
            ),
            json_decode($response->getBody()->getContents(), true),
        );
    }
}
