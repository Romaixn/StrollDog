<?php
namespace App\EventListener;

use App\Entity\Place;
use App\Utils\GeoApi;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class PlaceListener implements EventSubscriberInterface
{
    public function __construct(private GeoApi $geoApi)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::postPersist,
            Events::postUpdate,
        ];
    }

    public function postPersist(LifecycleEventArgs $args): void
    {
        $this->addGeo($args);
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->addGeo($args);
    }

    private function addGeo(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Place) {
            return;
        }

        $entityManager = $args->getObjectManager();

        $geo = $this->geoApi->getFromAddress($entity->getAddress(), $entity->getPostalCode());

        $entity->setLongitude($geo['longitude']);
        $entity->setLatitude($geo['latitude']);

        $entityManager->persist($entity);
        $entityManager->flush();
    }
}
