<?php

declare(strict_types=1);

namespace App\Controller\Traits;

use App\Domain\Security\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

trait BuildInertiaDefaultPropsTrait
{
    /**
     * @return array<mixed>
     */
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
                        'email' => $user->getEmail(),
                        'role' => $user->getRoles(),
                        'name' => $user->getName(),
                        'avatar' => $user->getImage(),
                    ]
                    : null,
            ],
            'isConnected' => $user !== null,
            'flash' => [
                'success' => $flashSuccessMessage,
                'error' => $flashErrorMessage,
            ],
        ];
    }
}
