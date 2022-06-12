<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Place\Enum\Influx;
use App\Domain\Place\Repository\TypeRepository;
use App\Domain\Place\Service\Search\Model\Search;
use App\Domain\Place\Service\Search\SearchPlace;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;

final class SearchController extends AbstractInertiaController
{
    public function __construct(
        private SearchPlace $searchPlace,
        private TypeRepository $typeRepository
    ) {
    }

    #[Route('/search', name: 'search', methods: ['GET'], options: ['expose' => true])]
    #[Route('/search', name: 'search_submit', methods: ['POST'], options: ['expose' => true])]
    public function index(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $search = new Search();

            [$places, $errors] = $this->handleFormData($request, $search);
        }

        $influxChoices = [];
        foreach (Influx::cases() as $influx) {
            $influxChoices[] = [
                'id' => $influx->name,
                'value' => $influx->value,
            ];
        }
        $typeChoices = [];
        foreach ($this->typeRepository->findAll() as $type) {
            $typeChoices[] = [
                'id' => $type->getId(),
                'value' => $type->getName(),
            ];
        }

        return $this->renderWithInertia('Search', [
            'places' => isset($places) ? new \ArrayObject($places) : new \ArrayObject(),
            'errors' => isset($errors) ? new \ArrayObject($errors) : new \ArrayObject(),
            'types' => $typeChoices,
            'influx' => $influxChoices,
        ]);
    }

    private function handleFormData(Request $request, Search $search): array
    {
        $search->setInflux(Influx::tryFrom($request->request->get('influx')));
        $search->setRatings($request->request->get('rating'));
        $search->setType($request->request->get('types') ? $this->typeRepository->find($request->request->get('types')) : null);

        $violations = $this->validator->validate($search);

        if ($violations->count() === 0) {
            return [$this->searchPlace->search($search), []];
        }

        $errors = [];
        foreach ($violations as $violation) {
            $propertyName = (string) s($violation->getPropertyPath())->snake();

            $errors[$propertyName] = (string) $violation->getMessage();
        }

        return [[], $errors];
    }
}
