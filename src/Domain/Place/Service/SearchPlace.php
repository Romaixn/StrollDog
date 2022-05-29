<?php

namespace App\Domain\Place\Service;

use App\Domain\Place\Repository\PlaceRepository;

class SearchPlace
{
    public function __construct(private PlaceRepository $placeRepository)
    {
    }

    public function search(array $criteria)
    {
        dump($criteria);
        return $this->placeRepository->search($criteria);
    }
}
