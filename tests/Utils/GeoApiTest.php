<?php

declare(strict_types=1);

namespace App\Tests\Utils;

use App\Domain\Place\Service\GeoApi\GeoApiInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GeoApiTest extends KernelTestCase
{
    private GeoApiInterface $geoApi;

    protected function setUp(): void
    {
        self::bootKernel();

        /* @var GeoApi $geoApi */
        $this->geoApi = static::getContainer()->get(GeoApiInterface::class);
    }

    public function testValid(): void
    {
        $coords = $this->geoApi->getFromAddress('8 bd du port', '44380');
        $this->assertEquals(-2.340983, $coords->getLongitude());
        $this->assertEquals(47.258811, $coords->getLatitude());
    }

    public function testInvalid(): void
    {
        $this->expectException(\Exception::class);

        $this->geoApi->getFromAddress('test', 'test');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
