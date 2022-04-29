<?php

namespace App\Http\Responses;

use Illuminate\Http\Client\Response;

class BinanceResponse extends Response
{
    public function ok()
    {
        return $this->status() === 200 && !$this->json('errors');
    }
}
