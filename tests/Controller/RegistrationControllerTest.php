<?php

namespace App\Tests;

use App\Domain\Security\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegisterForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/register');
        $this->assertResponseIsSuccessful();

        $client->submitForm('Register', [
            'registration_form[username]' => 'john_doe',
            'registration_form[email]' => 'john@doe.fr',
            'registration_form[name]' => 'John',
            'registration_form[plainPassword]' => 'johndoe1234',
        ]);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorTextContains('h1', 'Homepage');

        $userRepository = static::getContainer()->get(UserRepository::class);
        $user = $userRepository->findOneBy(['username' => 'john_doe']);

        $this->assertEquals('john@doe.fr', $user->getEmail());
        $this->assertEquals('John', $user->getName());
        $this->assertNotTrue($user->isVerified());
    }
}
