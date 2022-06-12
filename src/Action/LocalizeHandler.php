<?php

declare(strict_types=1);

namespace App\Action;

use App\Domain\Place\Service\GeoApi\GeoApiInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class LocalizeHandler
{
    public function __construct(private GeoApiInterface $geoApi)
    {
    }

    public function __invoke(Localize $message): void
    {
        $place = $message->getPlace();

        $coordinates = $this->geoApi->getFromAddress($place->getAddress(), $place->getPostalCode());

        $place->setLongitude($coordinates->getLongitude());
        $place->setLatitude($coordinates->getLatitude());
    }
}
