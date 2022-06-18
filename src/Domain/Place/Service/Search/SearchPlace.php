<?php

declare(strict_types=1);

namespace App\Domain\Place\Service\Search;

use App\Domain\Place\Service\Search\Model\Search;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use Elastica\Query\Range;
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
        $boolQuery = new BoolQuery();

        if($search->getType()) {
            $typeQuery = new MatchQuery();
            $typeQuery->setFieldQuery('types', $search->getType()->getName());
            $boolQuery->addMust($typeQuery);
        }

        if($search->getInflux()) {
            $influxQuery = new MatchQuery();
            $influxQuery->setFieldQuery('influx', $search->getInflux()->name);
            $boolQuery->addMust($influxQuery);
        }

        if($search->getRatings()) {
            $ratingsQuery = new Range();
            $ratingsQuery->addField('ratings', ['gte' => $search->getRatings()]);
            $boolQuery->addMust($ratingsQuery);
        }

        if($search->getQuery()) {
            $searchQuery = new MatchQuery();
            $searchQuery->setFieldQuery('title', $search->getQuery());
            $boolQuery->addMust($searchQuery);
        }

        return $this->placesFinder->findPaginated($boolQuery);
    }
}
