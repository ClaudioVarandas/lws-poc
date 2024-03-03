<?php

namespace Tests\Feature;

final class ServersEndpointDataProvider
{
    public static function providesServersFilters(): array
    {
        return [
            'all_possible_filters' => [
                'queryStringArr' => [
                    'location' => 'AmsterdamAMS-01',
                    'hdd_type' => 'sata',
                    'ram' => '16GB',
                    'storage' => ['0', '2TB']
                ],
                'count' => 7
            ],
            'filter_by_location_hdd_ram' => [
                'queryStringArr' => [
                    'location' => 'AmsterdamAMS-01',
                    'hdd_type' => 'sata',
                    'ram' => '16GB',
                ],
                'count' => 15
            ],
            'filter_by_location_hdd' => [
                'queryStringArr' => [
                    'location' => 'AmsterdamAMS-01',
                    'hdd_type' => 'sata',
                ],
                'count' => 68
            ],
            'filter_by_location' => [
                'queryStringArr' => [
                    'location' => 'AmsterdamAMS-01',
                ],
                'count' => 105
            ],
        ];
    }
}
