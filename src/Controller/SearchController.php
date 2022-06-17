<?php

declare(strict_types=1);

namespace App\Controller;

use RuntimeException;
use InvalidArgumentException;
use App\Domain\Place\Enum\Influx;
use function Symfony\Component\String\s;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Domain\Place\Repository\TypeRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Domain\Place\Service\Search\SearchPlace;
use App\Domain\Place\Service\Search\Model\Search;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

final class SearchController extends AbstractInertiaController
{
    public function __construct(
        private SearchPlace $searchPlace,
        private TypeRepository $typeRepository
    ) {
    }

    #[Route('/search', name: 'search', methods: ['GET'], options: ['expose' => true])]
    #[Route('/search', name: 'search_submit', methods: ['POST'], options: ['expose' => true])]
    public function index(Request $request, TranslatorInterface $translator): Response
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
        /** @var int $rating */
        $rating = $request->request->get('rating');
        /** @var string $influx */
        $influx = $request->request->get('influx');
        /** @var string $type */
        $type = $request->request->get('type');

        if($influx !== 'null') {
            $search->setInflux(Influx::tryFrom($influx));
        }

        if($rating !== 'null') {
            $search->setRatings((int) $rating);
        }

        if($type !== 'null' && $type = $this->typeRepository->find($type)) {
            $search->setType($type);
        }

        $violations = $this->validator->validate($search);

        if ($violations->count() === 0) {
            dump($this->searchPlace->search($search));
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
