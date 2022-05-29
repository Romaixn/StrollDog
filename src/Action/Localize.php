<?php

namespace App\Action;

use App\Domain\Place\Entity\Place;

final class Localize
{
    public function __construct(private Place $place)
    {
    }

    public function getPlace(): Place
    {
        return $this->place;
    }
}
