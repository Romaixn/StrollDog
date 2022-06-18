<?php

declare(strict_types=1);

namespace App\Domain\Place\Service\Search;

use App\Domain\Place\Service\Search\Model\Search;
use FOS\ElasticaBundle\Finder\TransformedFinder;

final class SearchPlace
{
    public function __construct(private TransformedFinder $placesFinder)
    {
    }

    /**
     * @return mixed
     */
    public function search(Search $search): mixed
    {
        return $this->placesFinder->find($search);
    }
}
