<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Place\Entity\Place;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PlaceController extends AbstractInertiaController
{
    #[Route('/place/{id}', name: 'place', methods: ['GET'], options: ['expose' => true]) ]
    public function index(Place $place): Response
    {
        return $this->renderWithInertia('Place', [
            'place' => $place,
        ]);
    }
}
