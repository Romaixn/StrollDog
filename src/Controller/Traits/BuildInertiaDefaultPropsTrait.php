<?php

declare(strict_types=1);

namespace App\Controller\Traits;

use App\Domain\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

trait BuildInertiaDefaultPropsTrait
{
    protected function buildDefaultProps(Request $request, ?User $user): array
    {
        $flashSuccessMessage = null;
        $flashErrorMessage = null;

        if ($request->hasSession()) {
            /** @var Session $session */
            $session = $request->getSession();

            if ($session->getFlashBag()->has('success')) {
                $flashSuccessMessages = $session->getFlashBag()->get('success');
                $flashSuccessMessage = reset($flashSuccessMessages);
            }

            if ($session->getFlashBag()->has('error')) {
                $flashErrorMessages = $session->getFlashBag()->get('error');
                $flashErrorMessage = reset($flashErrorMessages);
            }
        }

        return [
            'errors' => new \ArrayObject(),
            'auth' => [
                'user' => $user !== null
                    ? [
                        'username' => $user->getUsername(),
                        'role' => $user->getRoles(),
                    ]
                    : null,
            ],
            'flash' => [
                'success' => $flashSuccessMessage,
                'error' => $flashErrorMessage,
            ],
        ];
    }
}
