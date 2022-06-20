<?php

declare(strict_types=1);

namespace App\Controller;

use App\Domain\Security\Auth\AppAuthenticator;
use App\Domain\Security\Entity\User;
use App\Domain\Security\Repository\UserRepository;
use App\Domain\Security\Service\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use function Symfony\Component\String\s;
use Symfony\Component\Validator\ConstraintViolationInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

final class RegistrationController extends AbstractInertiaController
{
    public function __construct(
        private EmailVerifier $emailVerifier,
        private UserPasswordHasherInterface $passwordHasher,
        private EntityManagerInterface $entityManager,
    ) {
    }

    #[Route('/register', name: 'register', methods: ['GET'], options: ['expose' => true])]
    #[Route('/register_store', name: 'register_store', methods: ['POST'], options: ['expose' => true])]
    public function register(Request $request, UserAuthenticatorInterface $userAuthenticator, AppAuthenticator $authenticator): Response|null
    {
        if ($request->getMethod() === 'POST') {
            $user = new User();

            $errors = $this->handleFormData($request, $user, 'Bienvenue !');

            if (\count($errors) === 0) {
                // generate a signed url and email it to the user
                // $this->emailVerifier->sendEmailConfirmation(
                //     'verify_email',
                //     $user,
                //     (new TemplatedEmail())
                //         ->from(new Address($this->emailSender, 'StrollDog'))
                //         ->to($user->getEmail())
                //         ->subject('Please Confirm your Email')
                //         ->htmlTemplate('registration/confirmation_email.html.twig')
                // );

                return $userAuthenticator->authenticateUser(
                    $user,
                    $authenticator,
                    $request
                );
            }
        }

        return $this->renderWithInertia('Registration', [
            'errors' => $errors ?? [],
        ]);
    }

    #[Route('/verify/email', name: 'verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('error', $exception->getReason());

            return $this->redirectToRoute('register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('register');
    }

    /**
     * @return array<string, array<int, string>> Validation errors
     */
    private function handleFormData(Request $request, User $user, string $successMessage): array
    {
        /* @phpstan-ignore-next-line */
        $user->setUsername($request->request->get('username'));
        /* @phpstan-ignore-next-line */
        $user->setEmail($request->request->get('email'));
        /* @phpstan-ignore-next-line */
        $user->setName($request->request->get('name'));
        $user->setIsVerified(true);

        if ($request->request->has('password')) {
            /** @var string $password */
            $password = $request->request->get('password');

            if ($password !== '' && $password !== null) {
                $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            }
        }

        $violations = $this->validator->validate($user);

        if ($violations->count() === 0) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $this->addFlash('success', $successMessage);

            return [];
        }

        $errors = [];

        /** @var ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            $propertyName = (string) s($violation->getPropertyPath())->snake();

            $errors[$propertyName][] = (string) $violation->getMessage();
        }

        return $errors;
    }
}
