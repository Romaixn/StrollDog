<?php

declare(strict_types=1);

namespace App\Infrastructure\Search;

use App\Domain\Place\Service\Search\Model\Search;

interface SearchInterface
{
    public function search(Search $search): mixed;
}
