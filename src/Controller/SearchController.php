<?php

namespace App\Controller;

use App\Domain\Place\Service\SearchPlace;
use App\Domain\Place\Form\SearchPlaceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(Request $request, SearchPlace $searchPlace): Response
    {
        $form = $this->createForm(SearchPlaceType::class);
        $form->handleRequest($request);

        $result = null;
        if ($form->isSubmitted() && $form->isValid()) {
            $criteria = [
                'types' => $form->get('type')->getData()->toArray(),
                'influx' => $form->get('influx')->getData()->name,
                'ratings' => $form->get('ratings')->getData()
            ];

            $result = $searchPlace->search($criteria);
            dd($result);
        }

        return $this->render('search/search.html.twig', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }
}
