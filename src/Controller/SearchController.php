<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Place\Enum\Influx;
use App\Domain\Place\Repository\PlaceRepository;
use App\Domain\Place\Repository\TypeRepository;
use App\Domain\Place\Service\Search\Model\Search;
use App\Domain\Place\Service\Search\SearchPlace;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\s;
use Symfony\Contracts\Translation\TranslatorInterface;

final class SearchController extends AbstractInertiaController
{
    public function __construct(
        private SearchPlace $searchPlace,
        private TypeRepository $typeRepository
    ) { }

    #[Route('/search', name: 'search', methods: ['GET'], options: ['expose' => true])]
    #[Route('/search', name: 'search_submit', methods: ['POST'], options: ['expose' => true])]
    public function index(Request $request, TranslatorInterface $translator, PlaceRepository $placeRepository): Response
    {
        if ($request->getMethod() === 'POST') {
            $search = new Search();

            [$places, $errors] = $this->handleFormData($request, $search);
        }

        $influxChoices = [];
        foreach (Influx::cases() as $influx) {
            $influxChoices[] = [
                'label' => $translator->trans($influx->value),
                'value' => $influx->value,
            ];
        }

        $typeChoices = [];
        foreach ($this->typeRepository->findAll() as $type) {
            $typeChoices[] = [
                'label' => $type->getName(),
                'value' => $type->getId(),
            ];
        }

        $places = $places ?? $this->searchPlace->getAll();

        return $this->renderWithInertia('Search', [
            'places' => isset($places) ? $places : [],
            'errors' => isset($errors) ? $errors : [],
            'types' => $typeChoices,
            'influx' => $influxChoices,
        ]);
    }

    /**
     * @return array<mixed>
     */
    private function handleFormData(Request $request, Search $search): array
    {
        /** @var string $influx */
        $influx = $request->request->get('influx');
        /** @var string $type */
        $type = $request->request->get('type');
        /** @var string $query */
        $query = $request->request->get('search');

        if ($influx !== 'null') {
            $search->setInflux(Influx::tryFrom($influx));
        }

        if ($type !== 'null' && $type = $this->typeRepository->find($type)) {
            $search->setType($type);
        }

        if ($query !== 'null') {
            $search->setQuery($query);
        }

        $violations = $this->validator->validate($search);

        if ($violations->count() === 0) {
            return [$this->searchPlace->search($search), []];
        }

        $errors = [];
        foreach ($violations as $violation) {
            $propertyName = (string) s($violation->getPropertyPath())->snake();

            $errors[$propertyName][] = (string) $violation->getMessage();
        }

        return [[], $errors];
    }
}
