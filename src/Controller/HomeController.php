<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Place\Repository\PlaceRepository;
use App\Domain\Security\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

final class HomeController extends AbstractInertiaController
{
    #[Route('/', name: 'home', methods: ['GET'], options: ['expose' => true]) ]
    public function index(CacheInterface $cache, PlaceRepository $placeRepository, UserRepository $userRepository): Response
    {
        $placeCount = $cache->get('home_place_count', function () use ($placeRepository) {
            return $placeRepository->getNumber();
        });

        $userCount = $cache->get('home_user_count', function () use ($userRepository) {
            return $userRepository->getNumber();
        });

        $cityCount = $cache->get('home_city_count', function () use ($placeRepository) {
            return $placeRepository->getNumberCity();
        });

        return $this->renderWithInertia('Home', [
            'placeCount' => $placeCount,
            'userCount' => $userCount,
            'cityCount' => $cityCount,
        ]);
    }
}
