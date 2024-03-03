<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Tests\TestCase;

class ServersEndpointTest extends TestCase
{
    public function test_servers_endpoint_returns_correct_data_structure(): void
    {
        $response = $this->withHeaders($this->getHeaders())->get('/api/v1/servers');

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertIsArray($data);
        $row = $data[0];

        $this->assertArrayHasKey('model', $row);
        $this->assertIsString($row['model']);
        $this->assertArrayHasKey('ram', $row);
        $this->assertIsString($row['ram']);
        $this->assertArrayHasKey('hdd', $row);
        $this->assertIsString($row['hdd']);
        $this->assertArrayHasKey('location', $row);
        $this->assertIsString($row['location']);
        $this->assertArrayHasKey('price', $row);
        $this->assertIsString($row['price']);
    }

    /**
     * @
     * @param array $queryStringArr
     * @param int $expectedCount
     * @return void
     */
    #[DataProviderExternal(ServersEndpointDataProvider::class, 'providesServersFilters')]
    public function test_servers_endpoint_should_return_exact_records(array $queryStringArr, int $expectedCount): void
    {

        $queryString = http_build_query($queryStringArr);
        $uri = sprintf('/api/v1/servers?%s', $queryString);
        $response = $this->withHeaders($this->getHeaders())->get($uri);

        $response->assertStatus(200);
        $data = $response->json();

        $this->assertIsArray($data);
        $this->assertCount($expectedCount, $data);
    }

    public function test_servers_endpoint_should_return_422_when_validation_fails_for_storage(): void
    {
        $queryArr = [
            'location' => 'AmsterdamAMS-01',
            'hdd_type' => 'sata',
            'ram' => '16GB',
            'storage' => ['0']
        ];
        $queryString = http_build_query($queryArr);
        $uri = sprintf('/api/v1/servers?%s', $queryString);
        $response = $this->withHeaders($this->getHeaders())->get($uri);

        $response->assertStatus(422);

        $responseData = $response->json();

        $this->assertIsArray($responseData);
        $this->assertArrayHasKey('message',$responseData);
        $this->assertArrayHasKey('errors',$responseData);
        $this->assertIsArray($responseData['errors']);
    }

    public function test_servers_endpoint_should_return_422_when_validation_fails_for_location(): void
    {
        $queryArr = [
            'location' => 'AmsterdamAMS-01XXX',
            'hdd_type' => 'sata',
            'ram' => '16GB',
            'storage' => ['0','2TB']
        ];
        $queryString = http_build_query($queryArr);
        $uri = sprintf('/api/v1/servers?%s', $queryString);
        $response = $this->withHeaders($this->getHeaders())->get($uri);

        $response->assertStatus(422);

        $responseData = $response->json();

        $this->assertIsArray($responseData);
        $this->assertArrayHasKey('message',$responseData);
        $this->assertArrayHasKey('errors',$responseData);
        $this->assertIsArray($responseData['errors']);
    }

    public function test_servers_endpoint_should_return_422_when_validation_fails_for_hdd_type(): void
    {
        $queryArr = [
            'location' => 'AmsterdamAMS-01XXX',
            'hdd_type' => 'NVME',
            'ram' => '16GB',
            'storage' => ['0','2TB']
        ];
        $queryString = http_build_query($queryArr);
        $uri = sprintf('/api/v1/servers?%s', $queryString);
        $response = $this->withHeaders($this->getHeaders())->get($uri);

        $response->assertStatus(422);

        $responseData = $response->json();

        $this->assertIsArray($responseData);
        $this->assertArrayHasKey('message',$responseData);
        $this->assertArrayHasKey('errors',$responseData);
        $this->assertIsArray($responseData['errors']);
    }

    public function test_servers_endpoint_should_return_422_when_validation_fails_for_ram(): void
    {
        $queryArr = [
            'location' => 'AmsterdamAMS-01XXX',
            'hdd_type' => 'NVME',
            'ram' => '1666GB',
            'storage' => ['0','2TB']
        ];
        $queryString = http_build_query($queryArr);
        $uri = sprintf('/api/v1/servers?%s', $queryString);
        $response = $this->withHeaders($this->getHeaders())->get($uri);

        $response->assertStatus(422);

        $responseData = $response->json();

        $this->assertIsArray($responseData);
        $this->assertArrayHasKey('message',$responseData);
        $this->assertArrayHasKey('errors',$responseData);
        $this->assertIsArray($responseData['errors']);
    }

    private function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }
}
