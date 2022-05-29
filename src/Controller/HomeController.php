<?php

namespace App\Controller;

use Rompetomp\InertiaBundle\Service\InertiaInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(InertiaInterface $inertia): Response
    {
        return $inertia->render('Home');
    }
}
