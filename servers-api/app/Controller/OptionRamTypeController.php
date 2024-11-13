<?php

namespace App\Controller;

use App\Modules\Server\Enum\RamEnum;
use App\Response\ApiResponse;
use Illuminate\Http\Response;

class OptionRamTypeController extends Controller
{
    public function __construct(
        private readonly ApiResponse $apiResponse
    )
    {
    }

    public function index(): Response
    {
        return $this->apiResponse->respondSuccess(RamEnum::getList());
    }
}
