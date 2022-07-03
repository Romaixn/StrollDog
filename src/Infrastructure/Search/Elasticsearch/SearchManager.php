<?php

declare(strict_types=1);

namespace App\Infrastructure\Search\Elasticsearch;

use App\Domain\Place\Service\Search\Model\Search;
use App\Infrastructure\Search\SearchInterface;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;

class SearchManager implements SearchInterface
{
    public function __construct(private PaginatedFinderInterface $placesFinder)
    {
    }

    public function search(Search $search): mixed
    {
        $boolQuery = new BoolQuery();

        if ($search->getType()) {
            $typeQuery = new MatchQuery();
            $typeQuery->setFieldQuery('types', $search->getType()->getName());
            $boolQuery->addMust($typeQuery);
        }

        if ($search->getInflux()) {
            $influxQuery = new MatchQuery();
            $influxQuery->setFieldQuery('influx', $search->getInflux()->name);
            $boolQuery->addMust($influxQuery);
        }

        if ($search->getQuery()) {
            $searchQuery = new MatchQuery();
            $searchQuery->setFieldQuery('title', $search->getQuery());
            $boolQuery->addMust($searchQuery);
        }

        return $this->placesFinder->findPaginated($boolQuery);
    }

    public function getAll(): mixed
    {
        return $this->placesFinder->findPaginated('');
    }
}
