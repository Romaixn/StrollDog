<?php

namespace App\Controller;

use App\Domain\Place\Service\SearchPlace;
use App\Domain\Place\Form\SearchPlaceType;
use Rompetomp\InertiaBundle\Service\InertiaInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractInertiaController
{
    #[Route('/search', name: 'search', options: ['expose' => true]) ]
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

        return $this->renderWithInertia('Search', [
            'form' => $form->createView(),
            'result' => $result,
        ]);
    }
}
