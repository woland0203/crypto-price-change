<?php

namespace App\Services\Clients;

use App\Http\Responses\BinanceResponse;
use Illuminate\Support\Facades\Http;

class BinanceHttpClientService
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('api.binance.api_url');
    }

    public function get(string $url, array $query = []): BinanceResponse
    {
        $response = Http::get($this->apiUrl . $url, $query);

        return new BinanceResponse($response);
    }

    public function delete(string $url): void
    {
        //API has no method to delete, example return Http::delete($url);
        //return new BinanceResponse();
    }

    public function post(string $url, array $data): void
    {
        //API has no method to delete, example return Http::post($url, $data);
        //return new BinanceResponse();
    }
}
