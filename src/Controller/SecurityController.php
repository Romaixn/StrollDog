<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class SecurityController extends AbstractInertiaController
{
    #[Route('/login', name: 'login', methods: ['GET'], options: ['expose' => true])]
    #[Route('/login', name: 'login_attempt', methods: ['POST'], options: ['expose' => true])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $errors = $authenticationUtils->getLastAuthenticationError();

        $this->addFlash('error', $errors?->getMessage());

        return $this->renderWithInertia('Login', [
            'last_username' => $authenticationUtils->getLastUsername()
        ]);
    }

    #[Route('/logout', name: 'logout', options: ['expose' => true])]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
