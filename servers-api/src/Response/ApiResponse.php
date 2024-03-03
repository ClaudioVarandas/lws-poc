<?php

namespace App\Response;

use Illuminate\Http\Response;

class ApiResponse
{
    public function respondSuccess(array $data): Response
    {
        return new Response(
            content: $data,
            status: Response::HTTP_OK,
            headers: ['Content-Type' => 'application/json']
        );
    }
}
