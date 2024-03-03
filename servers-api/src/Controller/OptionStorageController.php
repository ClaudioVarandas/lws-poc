<?php

namespace App\Controller;

use App\Domain\Server\Enum\StorageEnum;
use App\Response\ApiResponse;
use Illuminate\Http\Response;

class OptionStorageController extends Controller
{
    public function __construct(
        private readonly ApiResponse $apiResponse
    )
    {
    }

    public function index(): Response
    {
        return $this->apiResponse->respondSuccess(StorageEnum::getList());
    }
}
