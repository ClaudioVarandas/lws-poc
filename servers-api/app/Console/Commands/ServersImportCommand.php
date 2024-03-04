<?php

namespace App\Console\Commands;

use App\Domain\Server\Handler\ServerImportHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ServersImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'servers:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import servers from csv file.';

    public function __construct(private readonly ServerImportHandler $serverImportHandler)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $sourceDisk = Storage::disk('import');
        $importFilename = 'servers_filters_assignment.csv';

        $dbDisk = Storage::disk('db');
        $serversFilename = 'servers_list.json';
        $locationsFilename = 'locations.json';

        $dbDisk->delete([$serversFilename, $locationsFilename]);

        if (!$sourceDisk->exists($importFilename)) {
            $this->warn(sprintf("File %s does not exists!", $importFilename));
            return Command::FAILURE;
        }


        $handle = fopen($sourceDisk->path($importFilename), 'r');

        $serversData = [];
        $locationsArr = [];
        $headers = [];
        $count = 0;

        while (($row = fgetcsv($handle, 1000, ";")) !== false) {
            if ($count === 0) {
                foreach ($row as $value) {
                    $headers[] = strtolower(preg_replace('/[^A-Za-z]/', '', $value));
                }
                $count++;
                continue;
            }

            $rowData = array_combine($headers, $row);

            foreach ($rowData as $key => $value) {
                switch ($key) {
                    case 'ram':
                        $ramArr = $this->serverImportHandler->handleRam($rowData['ram']);
                        $rowData = array_merge($rowData, $ramArr);
                        break;
                    case 'hdd':
                        $hddData = $this->serverImportHandler->handleHdd($rowData['hdd']);
                        $rowData = array_merge($rowData, $hddData);
                        break;
                    case 'location':
                        $key = substr($rowData['location'], -6);
                        $label = substr($rowData['location'], 0, strlen($rowData['location']) - 6);
                        $locationsArr[$rowData['location']] = $rowData['location'];
                        break;
                    default:
                        break;
                }
            }

            $serversData[] = $rowData;

            $count++;
        }

        $locationsData = $this->transformLocationsToList($locationsArr);

        $dbDisk->put($serversFilename, json_encode($serversData));
        $dbDisk->put($locationsFilename, json_encode($locationsData));

        $this->newLine();
        $this->info("Done importing file.");
        $this->newLine();
        $this->table(
            ['original_rows', 'imported_rows', 'locations_count'],
            [
                [$count - 1, count($serversData), count($locationsData)]
            ]
        );

        return Command::SUCCESS;
    }

    /**
     * @param array $locationsArr
     * @return array
     */
    private function transformLocationsToList(array $locationsArr): array
    {
        $locationsData = [];

        foreach ($locationsArr as $key => $label) {
            $locationsData[] = ['value' => $key, 'label' => $label];
        }

        return $locationsData;
    }
}
