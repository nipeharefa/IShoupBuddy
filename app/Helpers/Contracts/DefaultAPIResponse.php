<?php


namespace App\Helpers\Contracts;

interface DefaultAPIResponse
{
    public function onSuccess($data = [], $httpCode = 200);
    public function onFailure($data = [], $httpCode = 400);
}
