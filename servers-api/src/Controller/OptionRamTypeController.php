<?php

namespace App\Controller;

use App\Domain\Server\Enum\HddTypeEnum;
use App\Domain\Server\Enum\RamEnum;
use App\Domain\Server\Repository\OptionRepository;
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
