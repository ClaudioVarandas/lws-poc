<?php

namespace App\Domain\Server\Repository;

use App\Domain\Server\Request\ServerFormRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class ServerRepository
{
    public function getServers(ServerFormRequest $request): Collection
    {
        $json = Storage::disk('db')->get('servers_list.json');
        $serversCollection = collect(json_decode($json, true));
        $requestValidated = $request->validated();

        foreach ($requestValidated as $inputName => $inputValue){
            switch ($inputName){
                case 'location';
                    $serversCollection = $serversCollection->where('location', $request->input('location'));
                    break;
                case 'hdd_type';
                    $serversCollection = $serversCollection->where('hdd_type', $request->input('hdd_type'));
                    break;
                case 'ram';
                    $serversCollection = $serversCollection->where('ram_size',  $request->input('ram'));
                    break;
                case 'storage';
                    $serversCollection = $serversCollection->whereBetween('hdd_size', $request->input('storage'));
                    break;
            }
        }

        return $serversCollection;
    }
}
