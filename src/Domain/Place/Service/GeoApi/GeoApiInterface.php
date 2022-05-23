<?php
namespace App\Domain\Place\Service\GeoApi;

use App\Domain\Place\Service\GeoApi\Model\Coordinate;

interface GeoApiInterface
{
    public function getFromAddress(string $address, string $postalCode): Coordinate;
}
