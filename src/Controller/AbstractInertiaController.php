<?php

namespace App\Controller;

use App\Domain\Security\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Service\Attribute\Required;
use Symfony\Component\HttpFoundation\RequestStack;
use Rompetomp\InertiaBundle\Service\InertiaInterface;
use App\Controller\Traits\BuildInertiaDefaultPropsTrait;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractInertiaController extends AbstractController
{
    use BuildInertiaDefaultPropsTrait;

    protected InertiaInterface $inertia;
    protected ValidatorInterface $validator;
    protected RequestStack $requestStack;

    #[Required]
    public function setInertia(InertiaInterface $inertia): void
    {
        $this->inertia = $inertia;
    }

    #[Required]
    public function setValidator(ValidatorInterface $validator): void
    {
        $this->validator = $validator;
    }

    #[Required]
    public function setRequestStack(RequestStack $requestStack): void
    {
        $this->requestStack = $requestStack;
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
