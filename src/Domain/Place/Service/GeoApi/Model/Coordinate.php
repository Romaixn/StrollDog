<?php

declare(strict_types=1);

namespace App\Domain\Place\Service\GeoApi\Model;

class Coordinate
{
    public function __construct(
        private float $longitude,
        private float $latitude
    ) {
    }

    public function getLongitude(): float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }
}
