<?php

namespace App\Controller;

use App\Modules\Server\Repository\ServerRepository;
use App\Modules\Server\Request\ServerFormRequest;
use App\Modules\Server\ServerTransformer;
use App\Response\ApiResponse;
use Illuminate\Http\Response;

class ServersController extends Controller
{
    public function __construct(
        private readonly ServerRepository $serverRepository,
        private readonly ServerTransformer $serverTransformer,
        private readonly ApiResponse $apiResponse
    )
    {
    }

    public function index(ServerFormRequest $request): Response
    {
        $serversCollection = $this->serverRepository->getServers($request);

        return $this->apiResponse->respondSuccess(
            $this->serverTransformer->transformList($serversCollection->toArray())
        );
    }
}
