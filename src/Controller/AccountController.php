<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class AccountController extends AbstractInertiaController
{
    #[Route('/account', name: 'account', methods: ['GET'], options: ['expose' => true]) ]
    public function index(): Response
    {
        return $this->renderWithInertia('Account');
    }
}
