<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractInertiaController
{
    #[Route('/', name: 'home', options: ['expose' => true]) ]
    public function index(): Response
    {
        return $this->renderWithInertia('Home');
    }
}
