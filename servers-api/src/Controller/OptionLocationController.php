<?php

namespace App\Controller;

use App\Domain\Server\Repository\OptionRepository;
use App\Response\ApiResponse;
use Illuminate\Http\Response;

class OptionLocationController extends Controller
{
    public function __construct(
        private readonly OptionRepository $optionRepository,
        private readonly ApiResponse $apiResponse
    )
    {
    }

    public function index(): Response
    {
        $collection = $this->optionRepository->getLocations();

        return $this->apiResponse->respondSuccess($collection->toArray());
    }
}
