<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\TestCase;
use App\Domain\Security\Service\Validator;

class ValidatorTest extends TestCase
{
    private $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    public function testValidateUsername(): void
    {
        $test = 'username';

        $this->assertSame($test, $this->validator->validateUsername($test));
    }

    public function testValidateUsernameEmpty(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The username can not be empty.');
        $this->validator->validateUsername(null);
    }

    public function testValidateUsernameInvalid(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The username must contain only lowercase latin characters and underscores.');
        $this->validator->validateUsername('INVALID');
    }

    public function testValidatePassword(): void
    {
        $test = 'password';

        $this->assertSame($test, $this->validator->validatePassword($test));
    }

    public function testValidatePasswordEmpty(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The password can not be empty.');
        $this->validator->validatePassword(null);
    }

    public function testValidatePasswordInvalid(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The password must be at least 6 characters long.');
        $this->validator->validatePassword('12345');
    }

    public function testValidateEmail(): void
    {
        $test = '@';

        $this->assertSame($test, $this->validator->validateEmail($test));
    }

    public function testValidateEmailEmpty(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The email can not be empty.');
        $this->validator->validateEmail(null);
    }

    public function testValidateEmailInvalid(): void
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The email should look like a real email.');
        $this->validator->validateEmail('invalid');
    }

    public function testValidateName(): void
    {
        $test = 'Full Name';

        $this->assertSame($test, $this->validator->validateName($test));
    }

    public function testValidateNameEmpty()
    {
        $this->expectException('Exception');
        $this->expectExceptionMessage('The name can not be empty.');
        $this->validator->validateName(null);
    }
}
