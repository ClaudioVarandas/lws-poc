<?php

namespace App\Controller;

use App\Domain\Server\Repository\ServerRepository;
use App\Domain\Server\Request\ServerFormRequest;
use App\Domain\Server\ServerTransformer;
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
