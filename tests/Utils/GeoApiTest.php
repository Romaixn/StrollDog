<?php

namespace App\Tests\Utils;

use App\Domain\Place\Service\GeoApi\DataGouv\GeoApi;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GeoApiTest extends KernelTestCase
{
    private $geoApi;

    protected function setUp(): void
    {
        self::bootKernel();

        /** @var GeoApi $geoApi */
        $this->geoApi = static::getContainer()->get(GeoApi::class);
    }

    public function testValid(): void
    {
        $coords = $this->geoApi->getFromAddress('8 bd du port', '44380');
        $this->assertEquals(-2.340983, $coords['longitude']);
        $this->assertEquals(47.258811, $coords['latitude']);
    }

    public function testInvalid()
    {
        $this->expectException(\Exception::class);

        $this->geoApi->getFromAddress('test', 'test');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
