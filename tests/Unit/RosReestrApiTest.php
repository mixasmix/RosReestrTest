<?php

declare(strict_types = 1);

namespace Unit;

use App\DTO\PlotData;
use App\Service\External\RosReestrApi;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RosReestrApiTest extends KernelTestCase
{
    private $service;
    private $container;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->container = self::getContainer();
        $this->service = $this->container->get(RosReestrApi::class);
    }

    public function testGetPlotsData(): void
    {
        $httpClientMock = $this->createMock(Client::class);

        $httpClientMock->expects(self::any())->method('get')->willReturn(
            new Response(
                body: json_encode([$this->getMockData(), $this->getMockData()]),
            )
        );

        $this->container->set(Client::class, $httpClientMock);

        $result = $this->service->getPlotsData(['69:27:22:1306', '69:27:22:1307']);

        self::assertIsArray($result);

        self::assertIsObject(current($result));
    }

    private function getMockData(): array
    {
        return [
            'id' => '69:27:22:1306',
            'number' => '69:27:0000022:1306',
            'attrs' => [
                'plot_id' => '69:27:22:1306',
                'plot_area' => 10035,
                'plot_price' => 36126,
                'plot_number' => '69:27:0000022:1306',
                "plot_address" => 'Тверская область, р-н Ржевский, с/пос "Успенское", северо-западнее д. Горшково из земель СПКколхоз "Мирный"',
                'category_code' => '003001000000',
                'category_name' => 'Земли сельскохозяйственного назначения',
                'plot_area_inaccuracy' => 877,
                'permitted_use_document_name' => 'Для ведения сельского хозяйства',
                'permitted_use_classifier_code' => null,
                'permitted_use_classifier_name' => null
            ],
            'extent' => [
                'srs' => 'EPSG:4326',
                'xmax' => 34.449952796012,
                'xmin' => 34.447128341683,
                'ymax' => 56.240833833255,
                'ymin' => 56.239494097315,
                'width' => 0.0028244543283193,
                'height' => 0.0013397359402632
            ],
            'center' => [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        34.448540568847,
                        56.240163965285
                    ]
                ],
                'crs' => [
                    'type' => 'name',
                    'properties' => [
                        'name' => 'urn:ogc:def:crs:OGC:1.3:CRS84'
                    ]
                ]
            ],
            'spatial' => [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'MultiPolygon',
                    'coordinates' => [
                        [
                            [
                                [
                                    34.447128341683,
                                    56.239718149068
                                ],
                                [
                                    34.44733979958,
                                    56.240058075324
                                ],
                                [
                                    34.447995673621,
                                    56.240036980582
                                ],
                                [
                                    34.448626800625,
                                    56.239904843105
                                ],
                                [
                                    34.449064512325,
                                    56.239983229707
                                ],
                                [
                                    34.449241939342,
                                    56.240443490258
                                ],
                                [
                                    34.449414480731,
                                    56.240833833255
                                ],
                                [
                                    34.449952796012,
                                    56.240818391902
                                ],
                                [
                                    34.449559130043,
                                    56.239494097315
                                ]
                            ]
                        ]
                    ]
                ],
                'crs' => [
                    'type' => 'name',
                    'properties' => [
                        'name' => 'urn:ogc:def:crs:OGC:1.3:CRS84'
                    ]
                ]
            ],
            'created_at' => '2021-02-01T17:16:47+03:00',
            'updated_at' => '2022-12-26T21:09:14+03:00',
            '_links' => [
                'pkk' => [
                    'attrs' => [
                        'href' => null
                    ],
                    'search' => [
                        'href' => null
                    ],
                    'related' => [
                        'href' => null
                    ]
                ]
            ]
        ];
    }
}
