<?php

namespace Tests\Unit;

use App\Modules\Server\Handler\ServerImportHandler;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;
use Tests\Unit\DataProvider\ServerImportDataProvider;

class ServerImportHandlerTest extends TestCase
{
    /**
     * @param $value
     * @param $expectations
     * @return void
     */
    #[DataProviderExternal(ServerImportDataProvider::class, 'providesRamTestData')]
    public function test_it_should_handle_ram_and_return_proper_data_array($value,$expectations): void
    {
        $serverImportHandler = new ServerImportHandler();
        $data = $serverImportHandler->handleRam($value);

        $this->assertIsArray($data);
        $this->assertArrayHasKey('ram', $data);
        $this->assertSame($expectations['ram'],$data['ram']);
        $this->assertArrayHasKey('ram_size', $data);
        $this->assertSame($expectations['ram_size'],$data['ram_size']);
        $this->assertArrayHasKey('ram_size_unit', $data);
        $this->assertSame($expectations['ram_size_unit'],$data['ram_size_unit']);
        $this->assertArrayHasKey('ram_type', $data);
        $this->assertSame($expectations['ram_type'],$data['ram_type']);
    }
}
