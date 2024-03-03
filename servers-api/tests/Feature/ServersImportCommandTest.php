<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ServersImportCommandTest extends TestCase
{
    public function test_it_should_import_data_into_db_files(): void
    {
        Storage::fake('db');

        $serversFilename = 'servers_list.json';
        $locationsFilename = 'locations.json';

        $this->artisan('servers:import')
            ->expectsTable(['original_rows', 'imported_rows', 'locations_count'],
                [[486, 486, 7]]
            )
            ->assertExitCode(0);

        Storage::disk('db')->assertExists($locationsFilename);
        Storage::disk('db')->assertExists($serversFilename);
    }

}
