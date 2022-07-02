<?php

declare(strict_types=1);

namespace App\Domain\Place\Service\Search;

use App\Domain\Place\Service\Search\Model\Search;
use App\Infrastructure\Search\SearchInterface;

final class SearchPlace
{
    public function __construct(private SearchInterface $finder)
    {
    }

    public function search(Search $search): mixed
    {
        return $this->finder->search($search);
    }

    public function getAll(): mixed
    {
        return $this->finder->getAll();
    }
}
