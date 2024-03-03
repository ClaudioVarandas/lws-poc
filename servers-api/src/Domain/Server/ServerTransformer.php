<?php

namespace App\Domain\Server;

class ServerTransformer
{
    public function transformList(array $data): array
    {
        $returnData = [];

        foreach ($data as $row) {
            $returnData[] = [
                'model' => $row['model'],
                'ram' => $row['ram'],
                'hdd' => $row['hdd'],
                'price' => $row['price'],
                'location' => $row['location'],
            ];
        }
        return $returnData;
    }
}
