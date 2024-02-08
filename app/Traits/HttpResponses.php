<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\JsonResponse;

trait HttpResponses
{
    protected function success($message,$data,$code = 200): JsonResponse
    {
        return response()->json([
            "status" => "Request successfully commpleted",
            "message" => $message,
            "data" => $data
        ],$code);
    }

    protected function error($message,$data,$code): JsonResponse
    {
        return response()->json([
            "status" => "Request ",
            "message" => $message,
            "data" => $data
        ],$code);
    }
}
