<?php

namespace App\Controller;

use App\Modules\Server\Enum\HddTypeEnum;
use App\Response\ApiResponse;
use Illuminate\Http\Response;

class OptionHddTypeController extends Controller
{
    public function __construct(
        private readonly ApiResponse $apiResponse
    )
    {
    }

    public function index(): Response
    {
        return $this->apiResponse->respondSuccess(HddTypeEnum::getList());
    }
}
