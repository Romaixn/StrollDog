<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Place\Repository\PlaceRepository;
use App\Domain\Security\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HomeController extends AbstractInertiaController
{
    #[Route('/', name: 'home', methods: ['GET'], options: ['expose' => true]) ]
    public function index(PlaceRepository $placeRepository, UserRepository $userRepository): Response
    {
        $placeCount = $placeRepository->getNumber();
        $userCount = $userRepository->getNumber();

        return $this->renderWithInertia('Home', [
            'placeCount' => $placeCount,
            'userCount' => $userCount,
        ]);
    }
}
