<?php
namespace App\Utils;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class GeoApi
{
    public function __construct(private HttpClientInterface $client)
    {
        $this->client = $this->client->withOptions([
            'base_uri' => "https://api-adresse.data.gouv.fr/search/"
        ]);
    }

    public function getFromAddress(string $address, string $postalCode): array
    {
        $address = urlencode($address);

        $response = $this->client->request('GET', "?q=${address}&postcode=${postalCode}&limit=1");
        $data = $response->toArray(true);

        if (empty($data['features'])) {
            throw new \Exception('No results found');
        }

        $longitude = $data['features'][0]['geometry']['coordinates'][0];
        $latitude = $data['features'][0]['geometry']['coordinates'][1];

        return [
            'longitude' => $longitude,
            'latitude' => $latitude
        ];
    }
}
