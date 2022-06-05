<?php
namespace App\Domain\Place\EventListener;

use App\Action\Localize;
use App\Domain\Place\Entity\Place;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\Messenger\MessageBusInterface;


class PlaceListener implements EventSubscriberInterface
{
    public function __construct(private MessageBusInterface $bus)
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

        if ($context === 'create' && (!empty($entity->getLongitude()) || !empty($entity->getLatitude()))) {
            return;
        }

        $entityManager = $args->getObjectManager();

        $this->bus->dispatch(new Localize($entity));

        $entityManager->persist($entity);
        $entityManager->flush();
    }
}
