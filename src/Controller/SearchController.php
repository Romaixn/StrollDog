<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Place\Enum\Influx;
use App\Domain\Place\Repository\TypeRepository;
use App\Domain\Place\Service\Search\Model\Search;
use App\Domain\Place\Service\Search\SearchPlace;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use RuntimeException;
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
                'label' => $influx->value,
                'value' => $influx->name,
            ];
        }
        $typeChoices = [];
        foreach ($this->typeRepository->findAll() as $type) {
            $typeChoices[] = [
                'label' => $type->getName(),
                'value' => $type->getId(),
            ];
        }

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
        dd($request->request->get('rating'), $request->request->get('type'), $request->request->get('influx'));
        /** @phpstan-ignore-next-line */
        $search->setInflux(Influx::tryFrom($request->request->get('influx')));
        /** @phpstan-ignore-next-line */
        $search->setRatings($request->request->get('rating'));
        $search->setType($request->request->get('types') ? $this->typeRepository->find($request->request->get('types')) : null);

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
