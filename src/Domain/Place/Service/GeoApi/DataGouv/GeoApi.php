<?php
namespace App\Domain\Place\Service\GeoApi\DataGouv;

use App\Domain\Place\Service\GeoApi\GeoApiInterface;
use App\Domain\Place\Service\GeoApi\Model\Coordinate;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class GeoApi implements GeoApiInterface
{
    public function __construct(private HttpClientInterface $client)
    {
        $this->client = $this->client->withOptions([
            'base_uri' => "https://api-adresse.data.gouv.fr/search/"
        ]);
    }

    public function getFromAddress(string $address, string $postalCode): Coordinate
    {
        $address = urlencode($address);

        $response = $this->client->request('GET', "?q=${address}&postcode=${postalCode}&limit=1");
        $data = $response->toArray(true);

        if (empty($data['features'])) {
            throw new \Exception('No results');
        }

        $longitude = $data['features'][0]['geometry']['coordinates'][0];
        $latitude = $data['features'][0]['geometry']['coordinates'][1];

        return new Coordinate($longitude, $latitude);
    }
}
