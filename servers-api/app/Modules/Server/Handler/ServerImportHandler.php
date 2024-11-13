<?php declare(strict_types=1);

namespace App\Modules\Server\Handler;

class ServerImportHandler
{
    /**
     * Handles the ram field values, get the string and extract the necessary data
     * into fields for better handling
     *
     * @param string $ramValue
     * @return array
     */
    public function handleRam(string $ramValue): array
    {
        $size = 0;
        $type = '';

        if(!empty($ramValue)){
            $sizeLength = strlen($ramValue) - 4;
            $type = substr($ramValue, -4);
            $size = str_replace('GB', '', substr($ramValue, 0, $sizeLength));
        }

        return [
            'ram' => empty($ramValue) ? '' : $ramValue,
            'ram_size' => (int)$size,
            'ram_size_unit' => 'GB',
            'ram_type' => $type
        ];
    }

    /**
     *  Handles the hdd field values, get the string and extract the necessary data
     *  into fields for better handling
     *
     * @param string $hddValue
     * @return array
     */
    public function handleHdd(string $hddValue): array
    {
        $storageTypes = ['SATA2', 'SAS', 'SSD'];

        $rowData = [
            'hdd_type' => null,
            'hdd_size' => 0,
            'hdd_size_unit' => 'GB'
        ];

        foreach ($storageTypes as $type) {
            if (str_contains($hddValue, $type)) {
                $sizeUnitStr = str_replace(substr($hddValue, -(strlen($type))), '', $hddValue);
                $sizeUnit = substr($sizeUnitStr, -2);
                $sizeStr = str_replace($sizeUnit, '', $sizeUnitStr);
                $sizeArr = explode('x', $sizeStr);
                $sizeInGB = ($sizeUnit === 'TB') ? $sizeArr[1] * 1000 : $sizeArr[1];

                $rowData['hdd_type'] = $type;
                $rowData['hdd_size'] = $sizeInGB * (int)$sizeArr[0];

                break;
            }
        }

        return $rowData;
    }
}
