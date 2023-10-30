<?php

declare(strict_types = 1);

namespace App\Enum;

enum GeometryType: string
{
    case POINT = 'Point';
    case MULTI_POLYGON = 'MultiPolygon';
}
