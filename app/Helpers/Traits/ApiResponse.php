<?php


namespace App\Helpers\Traits;

trait ApiResponse {

	public function onSuccess($data = [], $httpCode = 200) {
        return response()->json($data, $httpCode);
    }

    public function onFailure($data = [], $httpCode = 400) {
        return response()->json($data, $httpCode);
    }
}