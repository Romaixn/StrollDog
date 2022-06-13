<?php

declare(strict_types=1);

namespace App\Domain\Place\Service\Search;

use App\Domain\Place\Entity\Place;
use App\Domain\Place\Repository\PlaceRepository;
use App\Domain\Place\Service\Search\Model\Search;

class SearchPlace
{
    public function __construct(private PlaceRepository $placeRepository)
    {
    }

    /**
     * @return mixed
     */
    public function search(Search $search): mixed
    {
        dump($search);

        return $this->placeRepository->search($search);
    }
}
