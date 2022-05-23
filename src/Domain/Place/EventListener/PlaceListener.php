<?php
namespace App\Domain\Place\EventListener;

use Doctrine\ORM\Events;
use App\Domain\Place\Entity\Place;
use App\Domain\Place\Service\GeoApi\GeoApiInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;

class PlaceListener implements EventSubscriberInterface
{
    public function __construct(private GeoApiInterface $geoApi)
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
        $this->addGeo($args, 'create');
    }

    public function postUpdate(LifecycleEventArgs $args): void
    {
        $this->addGeo($args, 'update');
    }

    private function addGeo(LifecycleEventArgs $args, string $context): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Place) {
            return;
        }

        if ($context === 'create' && (!empty($entity->getLongitude) || !empty($entity->getLatitude()))) {
            return;
        }

        $entityManager = $args->getObjectManager();

        $geo = $this->geoApi->getFromAddress($entity->getAddress(), $entity->getPostalCode());

        $entity->setLongitude($geo->getLongitude());
        $entity->setLatitude($geo->getLatitude());

        $entityManager->persist($entity);
        $entityManager->flush();
    }
}
