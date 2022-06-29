<?php

declare(strict_types=1);

namespace App\Action;

use App\Domain\Place\Service\GeoApi\GeoApiInterface;
use App\Infrastructure\Notification\NotificationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class LocalizeHandler
{
    public function __construct(
        private GeoApiInterface $geoApi,
        private NotificationService $notification
    ) {
    }

    public function __invoke(Localize $message): void
    {
        $place = $message->getPlace();

        try {
            $coordinates = $this->geoApi->getFromAddress($place->getAddress(), $place->getPostalCode());

            $place->setLongitude($coordinates->getLongitude());
            $place->setLatitude($coordinates->getLatitude());
        } catch (\Exception $e) {
            $this->notification->notify('error', $e->getMessage());

            $place->setLongitude(null);
            $place->setLatitude(null);
        }
    }
}
