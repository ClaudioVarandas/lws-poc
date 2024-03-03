<?php

namespace Tests\Unit\DataProvider;

final class ServerImportDataProvider
{
    public static function providesRamTestData(): array
    {
        return [
            'valid_value' => [
                'value' => '128GBDDR4',
                'expectations' => [
                    'ram' => '128GBDDR4',
                    'ram_size' => 128,
                    'ram_size_unit' => 'GB',
                    'ram_type' => 'DDR4'
                ]
            ],
            'invalid_value' => [
                'value' => 1250,
                'expectations' => [
                    'ram' => '1250',
                    'ram_size' => 0,
                    'ram_size_unit' => 'GB',
                    'ram_type' => '1250'
                ]
            ]
        ];
    }
}
