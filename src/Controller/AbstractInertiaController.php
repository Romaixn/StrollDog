<?php

namespace App\Controller;

use App\Domain\Security\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Rompetomp\InertiaBundle\Service\InertiaInterface;
use App\Controller\Traits\BuildInertiaDefaultPropsTrait;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class AbstractInertiaController extends AbstractController
{
    use BuildInertiaDefaultPropsTrait;

    public function __construct(
        protected InertiaInterface $inertia,
        protected ValidatorInterface $validator,
        private RequestStack $requestStack
    ) {
    }

    /**
     * @param array<string, mixed> $props
     * @param array<string, mixed> $viewData
     * @param array<string, mixed> $context
     */
    protected function renderWithInertia(
        string $component,
        array $props = [],
        array $viewData = [],
        array $context = []
    ): Response {
        /** @var ?User $currentUser */
        $currentUser = $this->getUser();

        $request = $this->requestStack->getCurrentRequest();

        if ($request === null) {
            throw new \RuntimeException('There is no current request.');
        }

        $defaultProps = $this->buildDefaultProps($request, $currentUser);

        return $this->inertia->render($component, array_merge($defaultProps, $props), $viewData, $context);
    }
}
