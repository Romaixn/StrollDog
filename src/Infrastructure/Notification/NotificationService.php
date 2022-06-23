<?php
declare(strict_types=1);

namespace App\Infrastructure\Notification;

use Symfony\Component\HttpFoundation\RequestStack;

class NotificationService
{
    public function __construct(private RequestStack $requestStack)
    {
    }

    public function notify(string $type, string $message): void
    {
        $this->requestStack->getCurrentRequest()?->getSession()->getFlashBag()->add($type, $message);
    }
}
